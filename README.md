# Demonstrasi SQL Injection
> [!WARNING]
> This repository is solely for learning/education for those interested in becoming ethical hackers/penetration testers to learn the practical skills needed to work in the field. If misused, the risk is borne by each individual. And this repository will be continuously updated if the account owner is in the mood to update it.

<br>

| Variable           |             Isi            |
| -------------------|----------------------------|
| **Nama**           |         Fadil Aditya Adzima    |
| **NIM**            |          312310617         |
| **Kelas**          |          TI.23.A.6         |
| **Mata Kuliah**    |      Pemrograman Web 2     |
| **Dosen Pengampu** | Agung Nugroho S.Kom., M.Kom.  |

<br>

## Apa itu SQL Injection?
SQL Injection (SQLi) adalah jenis serangan yang memungkinkan penyerang untuk menyisipkan (inject) kode SQL berbahaya ke dalam input yang dimasukkan oleh pengguna pada aplikasi web. Kode SQL yang disuntikkan ini akan dieksekusi oleh server basis data, yang bisa menyebabkan berbagai masalah, mulai dari pengambilan data secara tidak sah hingga perusakan atau penghapusan data.

## Teknik Serangan SQL Injection
### Serangan Bypass Authentication

Saat penyerang memasukkan ```' OR '1'='1 ``` pada field username dan sembarang password
```sql
-- Query yang terbentuk:
SELECT * FROM users WHERE username = '' OR '1'='1' AND password = 'anypassword';
```
Karena kondisi ```'1'='1'``` selalu bernilai <b>TRUE</b>, query ini akan mengembalikan semua baris dari tabel ```users```, sehingga memungkinkan penyerang masuk tanpa kredensial yang valid
<br>

![img](doc/1.png) <br> <br>

<br>

![img](doc/2.png) <br> <br>

Setelah tombol Login ditekan, server akan mengeksekusi query yang sudah dimodifikasi. Karena query mengembalikan hasil positif, autentikasi akan berhasil meskipun password tidak benar. <br> <br>


# $${\color{lightblue}PenjelasanTeknis}$$
Operator Prioritas dalam SQL <br>
SQL mengevaluasi operator AND sebelum operator OR. Jadi query
```sql
... WHERE username='admin' OR '1'='1' AND password='apa_saja'
```
diinterpretasikan sebagai:
```sql
... WHERE username='admin' OR ('1'='1' AND password='apa_saja')
```
Meskipun bagian ```'1'='1' AND password='apa_saja'``` mungkin bernilai FALSE (jika password salah), bagian ```username='admin'``` atau kondisi sebelum OR akan dievaluasi secara independen. Jika admin ada di database, syarat pertama bisa benar. Tetapi bahkan jika tidak, kondisi ```'1'='1'``` selalu benar, sehingga keseluruhan kondisi WHERE menjadi TRUE.

