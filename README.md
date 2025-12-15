Kalkulator Geometri OOP

📖 Deskripsi Proyek
Sistem Kalkulator Geometri ini digunakan untuk menghitung **luas dan keliling bangun datar**, yaitu:
- Persegi  
- Persegi Panjang  
- Segitiga  
- Lingkaran  

Aplikasi dibangun dengan menerapkan konsep OOP secara menyeluruh, seperti Abstraction, Inheritance, Polymorphism, Encapsulation, serta Custom Exception Handling.  
Selain melakukan perhitungan, sistem juga menyimpan riwayat hasil perhitungan ke dalam database MySQL menggunakan PDO.

---

🧠 Konsep OOP yang Diterapkan
- Abstract Class (`BangunDatar`)
- Interface (`Calculable`)
- Inheritance & Polymorphism pada class bangun datar
- Encapsulation pada atribut
- Custom Exception (`SisiNegatifException`, `DimensiTidakLengkapException`)
- MVC (Model-View-Controller) sederhana
- CRUD menggunakan PDO Prepared Statement

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
- PHP OOP (Native / Murni)
- MySQL
- PDO
- HTML & CSS
- MVC Architecture

---

✅ Fitur Utama
- Perhitungan luas dan keliling bangun datar
- Validasi input (tidak menerima nilai negatif / tidak lengkap)
- Custom error handling
- Penyimpanan dan penampilan riwayat perhitungan
- Struktur kode modular dan mudah dikembangkan

---

🧪 Pengujian
Pengujian dilakukan menggunakan skenario uji fungsional (black box testing) yang mencakup:
- Validasi perhitungan
- Pengujian polymorphism
- Pengujian custom exception
- Pengujian integrasi database

---

📌 Catatan
Proyek ini dikembangkan untuk keperluan akademik dan pembelajaran konsep OOP.  
Masih terbuka untuk pengembangan lanjutan seperti penambahan bangun ruang dan automated testing.

Final Project: PHP OOP Geometry Calculator with MVC, Custom Exception, and PDO Logging✨️