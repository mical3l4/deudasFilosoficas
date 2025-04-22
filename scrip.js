const container = document.querySelector(".container");
const btnsignin = document.getElementById("btn-sign-in");
const btnsigup = document.getElementById("btn-sign-up");
//const btn = document.getElementById("btn");

//btn.addEventListener("click", ()=>{
//   conatiner.classList.toggle("toggle");
//});



btnsignin.addEventListener("click",()=>{
   container.classList.remove("toggle");
});
btnsigup.addEventListener("click",()=>{
   container.classList.add("toggle")
});
