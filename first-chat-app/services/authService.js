const TOKEN_KEY = "my_app_token";

// Fungsi untuk menyimpan token JWT di local storage
export function saveToken(token) {
  localStorage.setItem(TOKEN_KEY, token);
}

export function saveUser(user) {
  localStorage.setItem("loggedInUser", JSON.stringify(user));
}

// Fungsi untuk mendapatkan token JWT dari penyimpanan lokal
export function getToken() {
  return localStorage.getItem(TOKEN_KEY);
}

export function getUserInfo() {
  const userData = localStorage.getItem("loggedInUser");
  if (userData) {
    return JSON.parse(userData);
  } else {
    return null; // atau nilai default lainnya
  }
}

// Fungsi untuk memeriksa apakah pengguna sudah login
export function isLoggedIn() {
  const token = getToken();
  return !!token; // Mengembalikan true jika token ada, false jika tidak
}

// Fungsi untuk melakukan logout
export function logout() {
  localStorage.removeItem(TOKEN_KEY);
  localStorage.removeItem("loggedInUser");
}
