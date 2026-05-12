window.addEventListener("load", async function () {
  const user = await authReady;
  if (!user) return;

  document.getElementById("userEmail").textContent = user.email;
  document.getElementById("userId").textContent = user.user_id;
});
