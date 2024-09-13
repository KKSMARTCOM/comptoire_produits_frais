<?php
// <!-- her sistem başlatıldığında çalışması için "autoload" alanına yazıldı -->

if (!function_exists('deleteFile')) {
    function deleteFile($filePath)
    {
        if (file_exists($filePath)) {
            if (!empty($filePath)) {
                unlink($filePath);
            }
        }
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($img, $name, $path)
    {
        $extension = $img->getClientOriginalExtension();
        $folderName = time() . '-' . Str::slug($name);

        if (in_array($extension, ['pdf', 'svg', 'webp', 'jiff'])) { // Process based on file extension
            $img->move(public_path($path), $folderName . '.' . $extension);

            $imgurl = $path . $folderName . '.' . $extension;
        } else {
            $img = ImageResize::make($img);

            $img->resize(640, 735, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->encode('webp', 75)->save($path . $folderName . '.webp');

            $imgurl = $path . $folderName . '.webp';
        }
        return $imgurl;
    }
}

if (!function_exists('strLimit')) {
    function strLimit($text, $limit, $url = null)
    {
        if ($url == null) {
            $end = '...';
        } else {
            $end = '<a class="ml-2" href="' . $url . '">[...]</a>';
        }
        return Str::limit($text, $limit, $end);
    }
}

if (!function_exists('folderOpen')) {
    function folderOpen($folderPath, $permissions = 0777)
    {
        if (!file_exists($folderPath)) {
            mkdir($folderPath, $permissions, true);
        }
    }
}

// random order number
if (!function_exists('generateOTP')) {
    function generateOTP($n)
    {
        $generator = "123456789123ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $result = '';
        for ($i = 1; $i < $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator)) - 1), 1);
        }
        return $result;
    }
}

if (!function_exists('encryptData')) {
    function encryptData($string)
    {
        return encrypt($string);
    }
}

if (!function_exists('decryptData')) {
    function decryptData($string)
    {
        return decrypt($string);
    }
}
