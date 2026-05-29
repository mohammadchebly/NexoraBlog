(function () {
  var themeButton = document.getElementById('theme-toggle');

  function savedTheme() {
    try {
      return localStorage.getItem('nexora-theme') || 'light';
    } catch (error) {
      return 'light';
    }
  }

  function saveTheme(theme) {
    try {
      localStorage.setItem('nexora-theme', theme);
    } catch (error) {
      // The page still changes theme when storage is unavailable.
    }
  }

  function applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);

    if (document.body) {
      document.body.setAttribute('data-theme', theme);
    }

    if (!themeButton) {
      return;
    }

    if (theme === 'dark') {
      themeButton.innerHTML = '☀ Light';
      themeButton.setAttribute('aria-pressed', 'true');
    } else {
      themeButton.innerHTML = '🌙 Dark';
      themeButton.setAttribute('aria-pressed', 'false');
    }
  }

  applyTheme(savedTheme());

  if (themeButton) {
    themeButton.onclick = function () {
      var currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
      var nextTheme = currentTheme === 'dark' ? 'light' : 'dark';

      saveTheme(nextTheme);
      applyTheme(nextTheme);
    };
  }
}());
