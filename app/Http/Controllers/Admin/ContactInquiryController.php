<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactInquiryUpdateRequest;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactInquiryController extends Controller
{
    public function index(Request $request, ?string $locale = null)
    {
        $perPage = (int) $request->query('per_page', 15);
        if (! in_array($perPage, [10, 15, 25, 50, 100], true)) {
            $perPage = 15;
        }

        $metrics = [
            'total' => ContactInquiry::count(),
            'new' => ContactInquiry::where('status', ContactInquiry::STATUS_NEW)->count(),
            'processing' => ContactInquiry::where('status', ContactInquiry::STATUS_PROCESSING)->count(),
            'replied' => ContactInquiry::where('status', ContactInquiry::STATUS_REPLIED)->count(),
        ];

        $inquiries = ContactInquiry::query()
            ->filter($request->only(['q', 'status', 'enquiry_type']))
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();

        $statuses = ContactInquiry::STATUSES;
        $types = ContactInquiry::ENQUIRY_TYPES;

        return view('admin.contact-inquiries.index', compact('inquiries', 'metrics', 'statuses', 'types', 'perPage'));
    }

    public function show(string $locale, ContactInquiry $contact_inquiry)
    {
        $statuses = ContactInquiry::STATUSES;

        return view('admin.contact-inquiries.show', compact('contact_inquiry', 'statuses'));
    }

    public function update(ContactInquiryUpdateRequest $request, string $locale, ContactInquiry $contact_inquiry)
    {
        $data = $request->validated();

        if ($data['status'] === ContactInquiry::STATUS_REPLIED && ! $contact_inquiry->replied_at) {
            $data['replied_at'] = now();
        }

        $contact_inquiry->update($data);

        return redirect()
            ->route('admin.contact-inquiries.show', $contact_inquiry)
            ->with('success', __('Cập nhật trạng thái và ghi chú yêu cầu thành công.'));
    }

    public function destroy(string $locale, ContactInquiry $contact_inquiry)
    {
        $contact_inquiry->delete();

        return redirect()
            ->route('admin.contact-inquiries.index')
            ->with('success', __('Đã xóa yêu cầu liên hệ thành công.'));
    }

    public function bulk(Request $request, ?string $locale = null)
    {
        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:contact_inquiries,id'],
            'action' => ['required', 'string', 'in:mark_new,mark_processing,mark_replied,mark_archived,delete'],
        ]);

        $ids = $validated['ids'];
        $action = $validated['action'];

        switch ($action) {
            case 'mark_new':
                ContactInquiry::whereIn('id', $ids)->update(['status' => ContactInquiry::STATUS_NEW]);
                $message = __('Đã chuyển :count yêu cầu sang trạng thái Mới.', ['count' => count($ids)]);
                break;
            case 'mark_processing':
                ContactInquiry::whereIn('id', $ids)->update(['status' => ContactInquiry::STATUS_PROCESSING]);
                $message = __('Đã chuyển :count yêu cầu sang trạng thái Đang xử lý.', ['count' => count($ids)]);
                break;
            case 'mark_replied':
                ContactInquiry::whereIn('id', $ids)->update([
                    'status' => ContactInquiry::STATUS_REPLIED,
                    'replied_at' => now(),
                ]);
                $message = __('Đã chuyển :count yêu cầu sang trạng thái Đã phản hồi.', ['count' => count($ids)]);
                break;
            case 'mark_archived':
                ContactInquiry::whereIn('id', $ids)->update(['status' => ContactInquiry::STATUS_ARCHIVED]);
                $message = __('Đã chuyển :count yêu cầu sang trạng thái Lưu trữ.', ['count' => count($ids)]);
                break;
            case 'delete':
                ContactInquiry::whereIn('id', $ids)->delete();
                $message = __('Đã xóa :count yêu cầu liên hệ thành công.', ['count' => count($ids)]);
                break;
        }

        return redirect()->back()->with('success', $message ?? __('Thao tác hàng loạt thành công.'));
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $inquiries = ContactInquiry::query()
            ->filter($request->only(['q', 'status', 'enquiry_type']))
            ->latest('id')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="luxlight_contact_inquiries_' . date('Ymd_His') . '.csv"',
        ];

        return response()->stream(function () use ($inquiries) {
            $handle = fopen('php://output', 'w');
            // Write UTF-8 BOM for Excel compatibility
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'ID',
                'Họ và tên',
                'Chức danh',
                'Công ty',
                'Email',
                'Số điện thoại',
                'Loại yêu cầu',
                'Trạng thái',
                'Nội dung',
                'Ghi chú nội bộ',
                'Ngày gửi',
                'Ngày phản hồi',
            ]);

            foreach ($inquiries as $item) {
                fputcsv($handle, [
                    $item->id,
                    $item->name,
                    $item->title,
                    $item->company,
                    $item->email,
                    $item->phone,
                    $item->enquiry_type,
                    $item->status_label,
                    $item->message,
                    $item->admin_notes,
                    $item->created_at?->format('d/m/Y H:i'),
                    $item->replied_at?->format('d/m/Y H:i'),
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}
