Kalkulator Geometri OOP

📖 Deskripsi Proyek
Sistem Kalkulator Geometri ini digunakan untuk menghitung **luas dan keliling bangun datar**, yaitu:
1. Persegi  
2. Persegi Panjang  
3. Segitiga  
4. Lingkaran  

Aplikasi dibangun dengan menerapkan konsep OOP secara menyeluruh, seperti Abstraction, Inheritance, Polymorphism, Encapsulation, serta Custom Exception Handling.  
Selain melakukan perhitungan, sistem juga menyimpan riwayat hasil perhitungan ke dalam database MySQL menggunakan PDO.

---

🧠 Konsep OOP yang Diterapkan
1. Abstract Class (`BangunDatar`)
2. Interface (`Calculable`)
3. Inheritance & Polymorphism pada class bangun datar
4. Encapsulation pada atribut
5. Custom Exception (`SisiNegatifException`, `DimensiTidakLengkapException`)
6. MVC (Model-View-Controller) sederhana
7. CRUD menggunakan PDO Prepared Statement

---

 🗂️ Struktur 

kalkulator-geometri-oop/
│   ├── Controllers/
│   │   └── GeometriController.php
│   │
│   ├── Models/
│   │   ├── BangunDatar.php
│   │   ├── Persegi.php
│   │   ├── PersegiPanjang.php
│   │   ├── Segitiga.php
│   │   ├── Lingkaran.php
│   │   ├── BangunModel.php
│   │   └── Model.php
│   │
│   ├── Interfaces/
│   │   └── Calculable.php
│   │   └── ErrorHandler.php
│   ├── Exceptions/
│   │   ├── SisiNegatifException.php
│   │   └── DimensiTidakLengkapException.php
│   │
├── config/
│   └── Database.php
│
├── public/
│   ├── index.php
│
├── schema
└── schema.sql

---

⚙️ Teknologi yang Digunakan
1. PHP OOP (Native / Murni)
2. MySQL
3. PDO
4. HTML & CSS
5. MVC Architecture

---

✅ Fitur Utama
1. Perhitungan luas dan keliling bangun datar
2. Validasi input (tidak menerima nilai negatif / tidak lengkap)
3. Custom error handling
4. Penyimpanan dan penampilan riwayat perhitungan
5. Struktur kode modular dan mudah dikembangkan

---

🧪 Pengujian
Pengujian dilakukan menggunakan skenario uji fungsional (black box testing) yang mencakup:
1. Validasi perhitungan
2. Pengujian polymorphism
3. Pengujian custom exception
4. Pengujian integrasi database

---

📌 Catatan
Proyek ini dikembangkan untuk keperluan akademik dan pembelajaran konsep OOP.  
Masih terbuka untuk pengembangan lanjutan seperti penambahan bangun ruang dan automated testing.

Final Project: PHP OOP Geometry Calculator with MVC, Custom Exception, and PDO Logging✨️