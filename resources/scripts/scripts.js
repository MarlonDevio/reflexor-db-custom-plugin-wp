import '../styles/style.css';
import Cookies from 'js-cookie';


const summaryContainer = document.querySelector('.entry-summary-items');

const div = document.createElement('div');
console.log(summaryContainer)
console.log(Cookies.get('wp-settings-time-1'));

const innerTable = `
<div class="bg-red-500">ANOTHER TEST</div>
<div class="bg-blue-500">BLUE TEST</div>
`
div.innerHTML = innerTable;
summaryContainer.appendChild(div);
