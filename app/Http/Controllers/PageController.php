<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.gioi-thieu');
    }

    public function brands()
    {
        return view('pages.thuong-hieu');
    }

    public function projects()
    {
        return view('pages.du-an');
    }

    public function technicalSupport()
    {
        return view('pages.ho-tro-ky-thuat');
    }

    public function news()
    {
        return view('pages.tin-tuc');
    }

    public function contact()
    {
        return view('pages.lien-he');
    }

    public function extract()
    {
        set_time_limit(600);
        ini_set('memory_limit', '512M');
        $baseDir = base_path();
        $zipFile = $baseDir . '/deploy.zip';
        if (!file_exists($zipFile)) {
            return response("ZIP_NOT_FOUND at $zipFile", 404);
        }
        if (!class_exists('ZipArchive')) {
            return response("NO_ZIP_ARCHIVE", 500);
        }
        $zip = new ZipArchive;
        if ($zip->open($zipFile) === TRUE) {
            if ($zip->extractTo($baseDir)) {
                $zip->close();
                @unlink($zipFile);
                return response("UNZIP_SUCCESS 200 OK", 200);
            }
            $zip->close();
            return response("UNZIP_EXTRACT_FAILED", 500);
        }
        return response("UNZIP_OPEN_FAILED", 500);
    }
}

