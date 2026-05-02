const form = document.getElementById('contactForm');
const msgEl = document.getElementById('message');
const btn = document.getElementById('submitBtn');
const btnText = btn.querySelector('.btn-text');
const btnLoader = btn.querySelector('.btn-loader');

form.addEventListener('submit', async (e) => {
  e.preventDefault();

  const name = document.getElementById('name').value.trim();
  const phone = document.getElementById('phone').value.trim();

  if (!name || !phone) {
    showMessage('Iltimos, barcha maydonlarni to\'ldiring!', 'error');
    return;
  }

  // Loading state
  btn.disabled = true;
  btnText.style.display = 'none';
  btnLoader.style.display = 'inline';
  msgEl.className = 'message';
  msgEl.style.display = 'none';

  try {
    const res = await fetch('/api/submit', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name, phone }),
    });

    const data = await res.json();

    if (res.ok && data.success) {
      showMessage('✅ Ma\'lumot muvaffaqiyatli saqlandi!', 'success');
      form.reset();
    } else {
      showMessage(data.message || '❌ Xatolik yuz berdi. Qayta urinib ko\'ring.', 'error');
    }
  } catch (err) {
    showMessage('❌ Server bilan bog\'lanishda xatolik.', 'error');
  } finally {
    btn.disabled = false;
    btnText.style.display = 'inline';
    btnLoader.style.display = 'none';
  }
});

function showMessage(text, type) {
  msgEl.textContent = text;
  msgEl.className = `message ${type}`;
}
