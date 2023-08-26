# dothocung
Sau khi import database đính kèm trong source code
Vào file  application/config/database.php thay đổi lại thông số cho phù hợp:
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'Tên đăng nhập database'';
$db['default']['password'] = 'Mật khẩu đăng nhập database';
$db['default']['database'] = 'Tên database';
Yêu cầu:Php Version >= 5.6, <= 7.35
Đăng nhập trang quản trị: http://['hostname']/admin
Tên đăng nhập: admin
Mật khẩu: 123
