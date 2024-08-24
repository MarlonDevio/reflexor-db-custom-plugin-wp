import '../styles/style.css';
import { wasInstructies } from '../images/svgs/index.js';

const washingInstructionsRow = document
  .querySelector('.woocommerce-product-attributes-item--attribute_pa_was-instructies')
  ?.querySelector('.woocommerce-product-attributes-item__value')
  ?.querySelector('p');

function createIcons(toMatch) {
  if (!toMatch) return null;

  const imageElement = document.createElement('img');
  imageElement.src = toMatch?.url;
  imageElement.alt = toMatch?.name;

  return imageElement;
}

function generateImages(instructionContainer) {
  return instructionContainer.textContent.split(', ').map((text) => {
    const matchingInstruction = wasInstructies.find((instruction) => instruction.name === text.trim());

    return createIcons(matchingInstruction);
  });
}

const images = generateImages(washingInstructionsRow);

washingInstructionsRow.textContent = ' ';
const container = document.createElement('div');
container.classList.add('flex', 'gap-2', 'w-full', 'h-full');
images.forEach((image) => {
  image.classList.add('w-20', 'h-20');
  container.appendChild(image);
});

// const summaryContainer = document.querySelector('.entry-summary-items');

const tabDesc = document.getElementById('tab-description');
tabDesc.appendChild(container);
// summaryContainer.appendChild(container);
