# TP4DPBO2024C2

/* Saya Talitha Fayarina Adhigunawan [2201271] mengerjakan TP4 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin. */

TP4 MVC ini diberi perintah berikut:
1. Buatlah database berdasarkan kode yang sudah ada
2. Ubah arsitektur project tersebut menggunakan MVC
3. Tambahkan tabel baru (1 - 2) yang berelasi dengan tabel yang sudah ada
4. Buat CRUD dari tabel baru tersebut

Pada TP4 MVC ini saya membuat database member untuk suatu Toko DVD Film. Toko ini menjual DVD-DVD berbagai film dan pada toko ini para customer bisa bergabung member pada toko ini, sehingga toko ini memiliki suatu database yang berisikan data dari member. Pada tabel pertama terdapat data tabel dari member yang terdiri dari id, nama, email, no telepon, dan film kesukaannya dan tabel kedua ada tabel film kesukaan.

Pada program ini bisa menambahkan member, delete member, menambah film dan delete film. Untuk edit member dan film sudah ada formnya namun belum bisa terubah datanya.

Berikut adalah desan programnya:
1. File Film.controller.php:
    - Class FilmController:
        - Properties:
            - $db: Objek untuk koneksi database.
            - $film: Objek untuk mengakses model Film.
        - Method __construct():
            - Menginisialisasi objek $db dan $film.
        - Method index():
            - Menampilkan semua film yang ada.
        - Method addFormFilm():
            - Menampilkan formulir untuk menambahkan film baru.
        - Method addFilm($nama_film):
            - Memproses penambahan film baru.
        - Method add($data):
            - Memanggil fungsi add pada model Film untuk menambahkan film ke database.
        - Method editFormFilm($id):
            - Menampilkan formulir untuk mengedit film berdasarkan ID.
        - Method edit($id, $nama_film):
            - Memproses pengeditan film.
        - Method deleteFilm($id):
            - Menghapus film berdasarkan ID.

2. File Member.controller.php:
    - Class MemberController:
        - Properties:
            - $member: Objek untuk mengakses model Member.
            - $film: Objek untuk mengakses model Film.
        - Method __construct():
            - Menginisialisasi objek $member dan $film.
        - Method index():
            - Menampilkan semua member yang ada.
        - Method getFilms():
            - Mendapatkan daftar film untuk digunakan dalam formulir.
        - Method addForm():
            - Menampilkan formulir untuk menambahkan member baru.
        - Method addData($nama, $email, $no_telp, $tanggal_join, $id_film):
            - Memproses penambahan member baru.
        - Method add($data):
            - Memanggil fungsi add pada model Member untuk menambahkan member ke database.
        - Method editForm($id):
            - Menampilkan formulir untuk mengedit member berdasarkan ID.
        - Method editData($id, $nama, $email, $no_telp, $tanggal_join, $id_film):
            - Memproses pengeditan member.
        - Method deleteData($id):
            - Menghapus member berdasarkan ID.
              
3. Film.class.php:
    - Class FilmClass:
        - Methods:
            - getAllFilm(): Mengambil semua data film dari database.
            - getFilmNameById($id_film): Mengambil nama film berdasarkan ID film.
            - getFilmById($id_film): Mengambil data film berdasarkan ID film.
            - add($data): Menambahkan data film baru ke database.
            - edit($id_film, $nama_film): Mengedit data film berdasarkan ID film.
            - delete($id): Menghapus data film berdasarkan ID film.

4. Member.class.php:
    - Class Member:
        - Methods:
            - getAllMember(): Mengambil semua data member dari database, termasuk nama film yang disukai.
            - getMemberById($id): Mengambil data member berdasarkan ID member.
            - add($data): Menambahkan data member baru ke database.
            - edit($id, $data): Mengedit data member berdasarkan ID member.
            - delete($id): Menghapus data member berdasarkan ID member.
         
5. DB.class.php:
    - Class DB:
        - Properties:
            - db_host: string, host database.
            - db_user: string, username database.
            - db_pass: string, password database.
            - db_name: string, nama database.
            - db_link: objek koneksi database.
            - result: hasil eksekusi query.
        - Methods:
            - __construct($db_host, $db_user, $db_pass, $db_name): konstruktor untuk menginisialisasi properti database.
            - open(): membuka koneksi ke database.
            - execute($query, $params = []): mengeksekusi query dengan atau tanpa parameter.
            - getResult(): mengambil hasil eksekusi query.
            - close(): menutup koneksi ke database.
            - isConnected(): memeriksa apakah koneksi database aktif.

6. Templates.class.php:
    - Class Template:
        - Properties:
            - filename: string, nama file template.
            - content: string, konten template.
        - Methods:
            - __construct($filename=''): konstruktor untuk menginisialisasi nama file template dan membaca konten template.
            - clear(): membersihkan konten template dari placeholder.
            - write(): menampilkan konten template.
            - getContent(): mendapatkan konten template.
            - replace($old = '', $new = ''): mengganti nilai placeholder dalam konten template.

7. index.html:
    - Template untuk halaman utama.
    - Menggunakan Bootstrap untuk tata letak.
    - Menampilkan navigasi, tombol tambah, dan tabel data.

8. skinform.html:
    - Template untuk halaman form.
    - Menggunakan Bootstrap untuk tata letak.
    - Menampilkan navigasi dan form.

9. Film.view.php:
    - Class FilmView:
        - Methods:
            - render($film): untuk menampilkan data film dalam bentuk tabel.
            - renderAddForm(): untuk menampilkan formulir penambahan data film.
            - renderEditForm($filmData): untuk menampilkan formulir edit data film.

10. Member.view.php:
    - Class MemberView:
        - Methods:
            - render($members): untuk menampilkan data member dalam bentuk tabel.
            - renderAddForm($films): untuk menampilkan formulir penambahan data member.
            - renderEditForm($memberData, $films): untuk menampilkan formulir edit data member.

11. film.php:
    - Script untuk mengontrol operasi terhadap data film:
        - Jika ada parameter 'add', akan memanggil fungsi AddFormFilm() untuk menampilkan formulir tambah film.
        - Jika ada parameter 'id_hapus', akan menghapus data film dengan memanggil fungsi deleteFilm().
        - Jika ada parameter 'id_edit', akan menampilkan formulir edit film dengan memanggil fungsi editFormFilm().
        - Jika tidak ada parameter, akan menampilkan data film dengan memanggil fungsi index().

12. index.php:
    - Script untuk mengontrol operasi terhadap data member:
        - Jika ada parameter 'add', akan menampilkan formulir tambah member dengan memanggil fungsi addForm().
        - Jika ada parameter 'id_hapus', akan menghapus data member dengan memanggil fungsi deleteData().
        - Jika ada parameter 'id_edit', akan menampilkan formulir edit member dengan memanggil fungsi editForm().
        - Jika tidak ada parameter, akan menampilkan data member dengan memanggil fungsi index().

13. conf.php:
    - Class Conf: menyediakan konfigurasi untuk koneksi ke database.
        - Properties: db_host, db_user, db_pass, db_name.
        - Methods: createConnection() untuk membuat objek koneksi ke database.

Dokumentasi:
- Halaman Home
  ![Home](https://github.com/faayyaa10/TP4DPBO2024C2/assets/114636102/ea497af2-fbaf-48eb-b73c-d089c76b74b9)

- Halaman Tambah Member
![Tambah Member](https://github.com/faayyaa10/TP4DPBO2024C2/assets/114636102/5531f666-0e19-4afe-a89a-7de23e9161e8)

- Halaman Edit Member
![Edit Member](https://github.com/faayyaa10/TP4DPBO2024C2/assets/114636102/00268ac5-1cc3-4d9c-a947-37973c594eb3)

- Halaman Film
![Halaman Film](https://github.com/faayyaa10/TP4DPBO2024C2/assets/114636102/0ad487ea-1c45-48a9-a446-ccca35557870)

- Halaman Tambah Film
![Tambah Film](https://github.com/faayyaa10/TP4DPBO2024C2/assets/114636102/926f07d9-368a-42e1-81ee-a5351311e728)

- Halaman Edit Film
![Edit Film](https://github.com/faayyaa10/TP4DPBO2024C2/assets/114636102/31345eb8-c912-4b07-afc0-a52a1ed4eb77)
