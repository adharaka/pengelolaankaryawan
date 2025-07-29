# Database Setup Guide - PlanetScale

## 1. Buat Akun PlanetScale
- Buka: https://planetscale.com
- Sign up dengan GitHub
- Pilih plan "Hobby" (gratis)

## 2. Buat Database
- Klik "New Database"
- Nama: `ujump_202507`
- Region: Singapore (terdekat)
- Plan: Hobby

## 3. Dapatkan Connection String
- Klik database yang dibuat
- Tab "Connect"
- Pilih "Connect with Prisma"
- Copy connection string

## 4. Environment Variables untuk Vercel
```
DB_CONNECTION=mysql
DB_HOST=aws.connect.psdb.cloud
DB_PORT=3306
DB_DATABASE=ujump_202507
DB_USERNAME=ujump_202507
DB_PASSWORD=P4ssword*$#123456
```

## 5. Import Database Schema
- Buka PlanetScale dashboard
- Tab "Schema"
- Import migration file dari Laravel