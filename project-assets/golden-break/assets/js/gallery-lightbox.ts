type GalleryImage = {
  src: string;
  alt: string;
};

class GalleryLightbox {
  private overlay: HTMLDivElement;
  private image: HTMLImageElement;
  private caption: HTMLParagraphElement;
  private counter: HTMLSpanElement;
  private previousButton: HTMLButtonElement;
  private nextButton: HTMLButtonElement;
  private closeButton: HTMLButtonElement;
  private images: GalleryImage[] = [];
  private activeIndex = 0;
  private lastTrigger: HTMLButtonElement | null = null;

  constructor() {
    this.overlay = document.createElement('div');
    this.overlay.className = 'gallery-lightbox';
    this.overlay.setAttribute('role', 'dialog');
    this.overlay.setAttribute('aria-modal', 'true');
    this.overlay.setAttribute('aria-label', 'Gallery');
    this.overlay.setAttribute('aria-hidden', 'true');

    this.closeButton = document.createElement('button');
    this.closeButton.className = 'gallery-lightbox__close';
    this.closeButton.type = 'button';
    this.closeButton.setAttribute('aria-label', '×');
    this.closeButton.innerHTML = '<span aria-hidden="true"></span>';

    this.previousButton = document.createElement('button');
    this.previousButton.className = 'gallery-lightbox__nav gallery-lightbox__nav--previous';
    this.previousButton.type = 'button';
    this.previousButton.setAttribute('aria-label', '←');
    this.previousButton.innerHTML = '<span aria-hidden="true"></span>';

    this.nextButton = document.createElement('button');
    this.nextButton.className = 'gallery-lightbox__nav gallery-lightbox__nav--next';
    this.nextButton.type = 'button';
    this.nextButton.setAttribute('aria-label', '→');
    this.nextButton.innerHTML = '<span aria-hidden="true"></span>';

    this.image = document.createElement('img');
    this.image.className = 'gallery-lightbox__image';
    this.image.alt = '';

    this.caption = document.createElement('p');
    this.caption.className = 'gallery-lightbox__caption';

    this.counter = document.createElement('span');
    this.counter.className = 'gallery-lightbox__counter';

    const figure = document.createElement('figure');
    figure.className = 'gallery-lightbox__figure';
    figure.append(this.image, this.caption);

    const controls = document.createElement('div');
    controls.className = 'gallery-lightbox__controls';
    controls.append(this.counter);

    this.overlay.append(
      this.closeButton,
      this.previousButton,
      figure,
      this.nextButton,
      controls,
    );

    document.body.append(this.overlay);
    this.bindOverlayEvents();
  }

  public bindGallery(gallery: HTMLElement): void {
    const triggers = Array.from(
      gallery.querySelectorAll<HTMLButtonElement>('[data-gallery-lightbox-trigger]'),
    );

    if (!triggers.length) {
      return;
    }

    triggers.forEach((trigger, index) => {
      trigger.addEventListener('click', () => {
        this.images = triggers.map((item) => ({
          src: item.dataset.gallerySrc || '',
          alt: item.dataset.galleryAlt || '',
        })).filter((item) => Boolean(item.src));

        this.lastTrigger = trigger;
        this.open(index);
      });
    });
  }

  private bindOverlayEvents(): void {
    this.closeButton.addEventListener('click', () => this.close());
    this.previousButton.addEventListener('click', () => this.showPrevious());
    this.nextButton.addEventListener('click', () => this.showNext());

    this.overlay.addEventListener('click', (event) => {
      if (event.target === this.overlay) {
        this.close();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (!this.isOpen()) {
        return;
      }

      if (event.key === 'Escape') {
        this.close();
      }

      if (event.key === 'ArrowLeft') {
        this.showPrevious();
      }

      if (event.key === 'ArrowRight') {
        this.showNext();
      }
    });
  }

  private open(index: number): void {
    if (!this.images.length) {
      return;
    }

    this.activeIndex = index;
    this.overlay.classList.add('is-open');
    this.overlay.setAttribute('aria-hidden', 'false');
    document.documentElement.classList.add('gallery-lightbox-is-open');
    this.render();
    this.closeButton.focus();
  }

  private close(): void {
    this.overlay.classList.remove('is-open');
    this.overlay.setAttribute('aria-hidden', 'true');
    document.documentElement.classList.remove('gallery-lightbox-is-open');
    this.lastTrigger?.focus();
  }

  private showPrevious(): void {
    this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
    this.render();
  }

  private showNext(): void {
    this.activeIndex = (this.activeIndex + 1) % this.images.length;
    this.render();
  }

  private render(): void {
    const activeImage = this.images[this.activeIndex];

    if (!activeImage) {
      return;
    }

    this.image.src = activeImage.src;
    this.image.alt = activeImage.alt;
    this.caption.textContent = activeImage.alt;
    this.caption.hidden = !activeImage.alt;
    this.counter.textContent = `${this.activeIndex + 1} / ${this.images.length}`;
    this.previousButton.hidden = this.images.length < 2;
    this.nextButton.hidden = this.images.length < 2;
  }

  private isOpen(): boolean {
    return this.overlay.classList.contains('is-open');
  }
}

const initGalleryLightbox = (): void => {
  const galleries = document.querySelectorAll<HTMLElement>('.gallery-block');

  if (!galleries.length) {
    return;
  }

  const lightbox = new GalleryLightbox();
  galleries.forEach((gallery) => lightbox.bindGallery(gallery));
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initGalleryLightbox);
} else {
  initGalleryLightbox();
}
