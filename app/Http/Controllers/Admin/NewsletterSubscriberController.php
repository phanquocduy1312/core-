<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NewsletterSubscriberController extends Controller
{
    public function index(Request $request, ?string $locale = null)
    {
        $perPage = (int) $request->query('per_page', 15);
        if (! in_array($perPage, [10, 15, 25, 50, 100], true)) {
            $perPage = 15;
        }

        $metrics = [
            'total' => NewsletterSubscriber::count(),
            'active' => NewsletterSubscriber::where('is_active', true)->count(),
            'new_this_month' => NewsletterSubscriber::where('created_at', '>=', now()->startOfMonth())->count(),
            'unsubscribed' => NewsletterSubscriber::where('is_active', false)->count(),
        ];

        $subscribers = NewsletterSubscriber::query()
            ->filter($request->only(['q', 'status', 'referral']))
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();

        $referrals = NewsletterSubscriber::REFERRALS;

        return view('admin.newsletter-subscribers.index', compact('subscribers', 'metrics', 'referrals', 'perPage'));
    }

    public function toggleStatus(string $locale, NewsletterSubscriber $newsletter_subscriber)
    {
        $newStatus = ! $newsletter_subscriber->is_active;

        $newsletter_subscriber->update([
            'is_active' => $newStatus,
            'subscribed_at' => $newStatus ? now() : $newsletter_subscriber->subscribed_at,
            'unsubscribed_at' => $newStatus ? null : now(),
        ]);

        return redirect()->back()->with('success', $newStatus
            ? __('Đã kích hoạt lại trạng thái theo dõi.')
            : __('Đã chuyển sang trạng thái hủy theo dõi.'));
    }

    public function destroy(string $locale, NewsletterSubscriber $newsletter_subscriber)
    {
        $newsletter_subscriber->delete();

        return redirect()
            ->route('admin.newsletter-subscribers.index')
            ->with('success', __('Đã xóa người đăng ký thành công.'));
    }

    public function bulk(Request $request, ?string $locale = null)
    {
        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:newsletter_subscribers,id'],
            'action' => ['required', 'string', 'in:activate,deactivate,delete'],
        ]);

        $ids = $validated['ids'];
        $action = $validated['action'];

        switch ($action) {
            case 'activate':
                NewsletterSubscriber::whereIn('id', $ids)->update([
                    'is_active' => true,
                    'subscribed_at' => now(),
                    'unsubscribed_at' => null,
                ]);
                $message = __('Đã kích hoạt theo dõi cho :count người đăng ký.', ['count' => count($ids)]);
                break;
            case 'deactivate':
                NewsletterSubscriber::whereIn('id', $ids)->update([
                    'is_active' => false,
                    'unsubscribed_at' => now(),
                ]);
                $message = __('Đã hủy theo dõi cho :count người đăng ký.', ['count' => count($ids)]);
                break;
            case 'delete':
                NewsletterSubscriber::whereIn('id', $ids)->delete();
                $message = __('Đã xóa :count người đăng ký thành công.', ['count' => count($ids)]);
                break;
        }

        return redirect()->back()->with('success', $message ?? __('Thao tác hàng loạt thành công.'));
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $subscribers = NewsletterSubscriber::query()
            ->filter($request->only(['q', 'status', 'referral']))
            ->latest('id')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="luxlight_newsletter_subscribers_' . date('Ymd_His') . '.csv"',
        ];

        return response()->stream(function () use ($subscribers) {
            $handle = fopen('php://output', 'w');
            // UTF-8 BOM
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'ID',
                'Email',
                'Họ và tên đệm',
                'Tên',
                'Họ và tên',
                'Công ty',
                'Kênh tiếp cận',
                'Trạng thái',
                'Ngày đăng ký',
                'Địa chỉ IP',
            ]);

            foreach ($subscribers as $item) {
                fputcsv($handle, [
                    $item->id,
                    $item->email,
                    $item->first_name,
                    $item->last_name,
                    $item->full_name,
                    $item->company,
                    $item->referral,
                    $item->is_active ? 'Đang theo dõi' : 'Đã hủy theo dõi',
                    $item->subscribed_at?->format('d/m/Y H:i'),
                    $item->ip_address,
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}
