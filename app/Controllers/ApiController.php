<?php

namespace App\Controllers;

use Config\EnvironmentPlatform;

abstract class ApiController extends BaseController
{

    protected function getEnvironmentPlatform()
    {
        $platform = config('EnvironmentPlatform')->platform;
        $color = config('EnvironmentPlatform')->platformSettings[$platform]['color'];
        $icon = config('EnvironmentPlatform')->platformSettings[$platform]['icon'];
        $platform = config('EnvironmentPlatform')->platformSettings[$platform]['platform'];
        $baseUrl = config('EnvironmentPlatform')->platformSettings[$platform]['base_url'];
        $dbPrefix = config('EnvironmentPlatform')->platformSettings[$platform]['prefix_db'];
        return [
            "color" => $color,
            "icon" => $icon,
            "platform" => $platform,
            "base_url" => $baseUrl,
            "db_prefix" => $dbPrefix,
        ];
    }
    protected function apiResponseList($status, $message, $data = [], $totalData = null, $perPage = 10, $currentPage = null)
    {



        $response = [
            'status' =>  (int) $status,
            'message' => $message,
            'data' => $data,
            'total_data' => (int)  $totalData,
            'total_page' => (int)  ceil($totalData / $perPage),
            'page' => (int)  $currentPage,
            'theme' => $this->getEnvironmentPlatform()
        ];

        return response()->setJSON($response)->setStatusCode($status);
    }
    protected function apiResponse($code, $message, $data = null)
    {
        $response = [

            'status' => (int) $code,
            'message' => $message,
            'data' => $data,
            'theme' => $this->getEnvironmentPlatform()
        ];

        return response()->setJSON($response)->setStatusCode($code);
    }

    function base64_to_image($base64_string, $base_folder_path, $fileName)
    {

        // ambil format depan dan base64string
        try {
            list($format, $base64Data) = explode(',', $base64_string, 2);

            // Ekstrak ekstensi dari format
            list(, $data) = explode('/', $format);
            list($extension,) = explode(';', $data);

            // Decode base64 string to binary data
            $image_data = base64_decode($base64Data);

            // Folder untuk menyimpan file
            $folder_path = $base_folder_path;

            // Membuat folder jika belum ada
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }

            // Jalur lengkap file
            $file_path = $folder_path . '/' . $fileName . '.' . $extension;

            // Save the image to the specified folder
            file_put_contents($file_path, $image_data);

            return $file_path;
        } catch (\Throwable $th) {
            return "image_kosong";
        }
        //get query string example 
        /// /22?id=22&name="sada"
        $queryId = $this->request->getGet('id');
        $queryKey = $this->request->getGet('key');
    }
}
