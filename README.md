# 📋 Contact Form — Railway + MySQL

Ism va telefon raqam formasi. Node.js + Express + MySQL (Railway).

---

## 🚀 Railway'ga Deploy qilish

### 1. GitHub'ga yuklash
```bash
git init
git add .
git commit -m "Initial commit"
git branch -M main  
git remote add origin https://github.com/USERNAME/REPO_NAME.git
git push -u origin main
```

### 2. Railway'da yangi loyiha ochish
1. [railway.app](https://railway.app) ga kiring
2. **New Project** → **Deploy from GitHub repo** bosing
3. Repozitoriyangizni tanlang

### 3. MySQL qo'shish
1. Railway loyiha ichida **+ Add Service** → **Database** → **MySQL** bosing
2. MySQL service yaratilgach, uning **Variables** bo'limiga o'ting
3. `MYSQLHOST`, `MYSQLPORT`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE` qiymatlarini ko'ring

### 4. Environment Variables ulash
Railway loyihangizda **Variables** bo'limiga o'ting va MySQL service'dan olingan qiymatlarni qo'shing:

```
MYSQLHOST=...
MYSQLPORT=3306
MYSQLUSER=root
MYSQLPASSWORD=...
MYSQLDATABASE=railway
```

> ⚠️ Railway ba'zan MySQL o'zgaruvchilarini avtomatik ulaydi — **Reference** tugmasi orqali bog'lash mumkin.

### 5. Deploy!
Railway avtomatik `npm start` komandani ishlatadi. Jadval (`contacts`) o'zi yaratiladi.

---

## 💻 Lokal ishlatish

```bash
npm install
cp .env.example .env
# .env faylni to'ldiring
npm run dev
```

`http://localhost:3000` da oching.

---

## 🗄️ Baza Strukturasi

```sql
CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  phone VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 📡 API Endpointlar

| Method | URL | Tavsif |
|--------|-----|--------|
| POST | `/api/submit` | Yangi ma'lumot saqlash |
| GET | `/api/contacts` | Barcha ma'lumotlarni olish |
