const express = require('express');
const mysql = require('mysql2/promise');
const path = require('path');
require('dotenv').config();

const app = express();
app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

// MySQL ulanish (Railway environment variables)
const dbConfig = {
  host: process.env.MYSQLHOST || 'mysql.railway.internal',
  port: process.env.MYSQLPORT || 3306,
  user: process.env.MYSQLUSER || 'root',
  password: process.env.MYSQLPASSWORD || 'IBVDBzKYoJGNKDbGOVDvTWDAayyKNuKV',
  database: process.env.MYSQLDATABASE || 'railway',
};

let pool;

async function initDB() {
  try {
    pool = await mysql.createPool(dbConfig);

    // Jadval yaratish (agar mavjud bo'lmasa)
    await pool.execute(`
      CREATE TABLE IF NOT EXISTS contacts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )
    `);
    console.log('✅ MySQL ulanish va jadval tayyor!');
  } catch (err) {
    console.error('❌ MySQL ulanishda xatolik:', err.message);
    process.exit(1);
  }
}

// API endpoint
app.post('/api/submit', async (req, res) => {
  try {
    const { name, phone } = req.body;

    if (!name || !phone) {
      return res.status(400).json({ success: false, message: 'Ism va telefon raqam majburiy!' });
    }

    await pool.execute(
      'INSERT INTO contacts (name, phone) VALUES (?, ?)',
      [name.trim(), phone.trim()]
    );

    res.json({ success: true, message: 'Ma\'lumot saqlandi!' });
  } catch (err) {
    console.error('DB xatolik:', err.message);
    res.status(500).json({ success: false, message: 'Server xatoligi.' });
  }
});

// Barcha ma'lumotlarni olish (test uchun)
app.get('/api/contacts', async (req, res) => {
  try {
    const [rows] = await pool.execute('SELECT * FROM contacts ORDER BY created_at DESC');
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

const PORT = process.env.PORT || 3000;

initDB().then(() => {
  app.listen(PORT, () => {
    console.log(`🚀 Server ishga tushdi: http://localhost:${PORT}`);
  });
});
