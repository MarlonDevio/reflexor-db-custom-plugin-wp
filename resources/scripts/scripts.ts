import '../styles/style.css';
import { wasInstructies } from '../images/svgs/index';

const washingInstructionsRow = document
  .querySelector('.woocommerce-product-attributes-item--attribute_pa_was-instructies')
  ?.querySelector('.woocommerce-product-attributes-item__value')
  ?.querySelector('p');

function createIcons(toMatch: { name: string; url: any } | undefined): HTMLImageElement {
  const imageElement: HTMLImageElement = document.createElement('img');
  // eslint-disable-next-line @typescript-eslint/no-unsafe-assignment,@typescript-eslint/no-unsafe-member-access
  imageElement.src = toMatch?.url;
  // eslint-disable-next-line @typescript-eslint/no-unsafe-assignment,@typescript-eslint/no-unsafe-member-access
  imageElement.alt = <string>toMatch?.name;

  return imageElement;
}

function generateImages(instructionContainer: HTMLElement): HTMLImageElement[] | undefined {
  return instructionContainer.textContent?.split(', ').map((text) => {
    const matchingInstruction = wasInstructies.find((instruction) => instruction.name === text.trim());

    return createIcons(matchingInstruction);
  });
}

// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-expect-error
const images = generateImages(washingInstructionsRow);

const container = document.createElement('div');
container.classList.add('flex', 'gap-2', 'w-full', 'h-full');
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-expect-error
images.forEach((image) => {
  image.classList.add('w-20', 'h-20');
  container.appendChild(image);
});

// const summaryContainer = document.querySelector('.entry-summary-items');

const tabDesc = document.getElementById('tab-description');
tabDesc?.appendChild(container);
// summaryContainer.appendChild(container);
