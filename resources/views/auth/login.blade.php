<!DOCTYPE html>
<html>
<head>
    <title>Login Firebase</title>
</head>
<body>

<h3>Login</h3>
<input type="email" id="email" placeholder="Email">
<input type="password" id="password" placeholder="Password">
<button onclick="login()">Login</button>

<script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getAuth, signInWithEmailAndPassword } 
from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

const firebaseConfig = {
  apiKey: "AIzaSyC-5z9Ypgw7vDXmvA-tnW-aJ9OQJYtCobs",
  authDomain: "inventory-uas-web.firebaseapp.com",
  databaseURL: "https://inventory-uas-web-default-rtdb.firebaseio.com",
  projectId: "inventory-uas-web",
  storageBucket: "inventory-uas-web.firebasestorage.app",
  messagingSenderId: "481277432382",
  appId: "1:481277432382:web:4d0f19796a30929311f76f"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

window.login = function () {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  signInWithEmailAndPassword(auth, email, password)
    .then(userCredential => userCredential.user.getIdToken())
    .then(token => {
      return fetch("/firebase-login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ token })
      });
    })
    .then(() => window.location.href = "/form-data")
    .catch(err => alert(err.message));
}
</script>

</body>
</html>
