function startApp(){dateSearch()}function dateSearch(){document.querySelector("#date").addEventListener("input",t=>{const e=t.target.value;window.location="?date="+e})}document.addEventListener("DOMContentLoaded",()=>{startApp()});