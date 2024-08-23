import '../styles/style.css';
import Cookies from 'js-cookie';
import {images} from "../images/index.js";


const summaryContainer = document.querySelector('.entry-summary-items');

const div = document.createElement('div');
console.log(summaryContainer)
console.log(Cookies.get('wp-settings-time-1'));

const innerTable = `
<div class="border-[0.5px] border-black flex w-full">
<div class="grid grid-cols-4 gap-2">
${images.map(images => `<img src=${images} class="w-12 h-12" alt="">`).join('')}
</div>
</div>
`
div.innerHTML = innerTable;
summaryContainer.appendChild(div);
