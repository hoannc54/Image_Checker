# Image Checker

## Intro

Thư viện kiểm tra định dạng của ảnh

## Usage
Khởi tạo đối tượng, truyền vào một đường dẫn local hoặc một url web chứa ảnh
```
$image_checker = new \Joan\ImageChecker\ImageChecker($path);
```

Lấy định dạng của ảnh

```
$image_checker->detect()
```

Kiểm tra ảnh có phải loại mong muốn không

```
$image_checker->isGif()
$image_checker->isPng()
```

## Test

Chạy test : 
```
./vendor/bin/phpunit ImageCheckerTest tests/ImageCheckerTest.php
```
