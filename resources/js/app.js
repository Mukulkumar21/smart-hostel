const html = document.documentElement;

// Page load par saved theme apply
if (localStorage.getItem('theme') === 'dark') {
    html.classList.add('dark');
}

// Button click handle (safe for all pages)
document.addEventListener('click', function (e) {
    const btn = e.target.closest('#theme-toggle');
    if (!btn) return;

    html.classList.toggle('dark');

    const isDark = html.classList.contains('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    btn.textContent = isDark ? '☀️' : '🌙';
});

// Page load par icon sync
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('theme-toggle');
    if (!btn) return;

    btn.textContent = html.classList.contains('dark') ? '☀️' : '🌙';
});
