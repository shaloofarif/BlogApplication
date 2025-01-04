document.addEventListener('DOMContentLoaded', function () {
  gsap.registerPlugin(ScrollTrigger);

  const viewMoreLink = document.getElementById('view-more');
  const hiddenFeatures = document.querySelectorAll('.features-wrapper.hidden');
  let isViewMore = true;

  function updateLastVisibleFeature() {
    const features = document.querySelectorAll('.features-wrapper');
    features.forEach(feature => feature.classList.remove('last-visible'));

    const visibleFeatures = Array.from(features).filter(feature => !feature.classList.contains('hidden'));
    if (visibleFeatures.length > 0) {
      visibleFeatures[visibleFeatures.length - 1].classList.add('last-visible');
    }
  }

  function initScrollTrigger() {
    const windowWidth = window.innerWidth;
    const imagePaths = {
      'grc-content': './assets/images/svg/governance.svg',
      'emr-content': './assets/images/svg/enterprise.svg',
      'audit-content': './assets/images/svg/audit.svg',
      'incident-content': './assets/images/svg/incident.svg',
      'business-content': './assets/images/svg/business.svg',
      'crisis-content': './assets/images/svg/crisis.svg',
      'strategy-content': './assets/images/svg/strategy.svg'
    };

    const managementSections = document.querySelectorAll('.management-content');

    if (windowWidth <= 991) {
      // Place images directly within management-content sections
      managementSections.forEach((section) => {
        const sectionClass = section.classList[1];
        const imgElement = section.querySelector('.management-image');
        imgElement.src = imagePaths[sectionClass];
      });
    } else {
      //  Remove images from management-content sections if screen width is greater than 991px
      managementSections.forEach((section) => {
        const imgElement = section.querySelector('.management-image');
        imgElement.src = '';
      });

      //  management-content sections
      const img = document.querySelector('.dynamic-image');

      managementSections.forEach((section, index) => {
        const sectionClass = section.classList[1];
        const progressInner = section.querySelector('.progress-inner');

        gsap.to(progressInner, {
          scrollTrigger: {
            trigger: section,
            start: "top center",
            end: "bottom+=10 center",
            scrub: 0.5,
            onUpdate: (self) => {
              const scrollProgress = self.progress;
              progressInner.style.width = `${scrollProgress * 100}%`;
            },
            onEnter: () => {
              section.classList.add('active');
              img.src = imagePaths[sectionClass];
            },
            onEnterBack: () => {
              section.classList.add('active');
              img.src = imagePaths[sectionClass];
            },
            onLeave: () => {
              section.classList.remove('active');
            },
            onLeaveBack: () => {
              section.classList.remove('active');
            },
            onComplete: () => {
              const nextIndex = index + 1;
              if (nextIndex < managementSections.length) {
                const nextSection = managementSections[nextIndex];
                nextSection.classList.add('active');
                img.src = imagePaths[nextSection.classList[1]];
                gsap.to(window, { scrollTo: nextSection, duration: 0.5 });
                ScrollTrigger.refresh();
              }
            }
          }
        });
      });
    }

    //  tech-features sections
    const techFeaturesSections = document.querySelectorAll('.tech-features-container .features-wrapper');

    techFeaturesSections.forEach((section, index) => {
      const progressInner = section.querySelector('.progress-inner');

      gsap.to(progressInner, {
        scrollTrigger: {
          trigger: section,
          start: "top center",
          end: "bottom+=10 center",
          scrub: 0.5,
          onUpdate: (self) => {
            const scrollProgress = self.progress;
            progressInner.style.width = `${scrollProgress * 100}%`;
          },
          onEnter: () => {
            section.classList.add('active');
          },
          onEnterBack: () => {
            section.classList.add('active');
          },
          onLeave: () => {
            section.classList.remove('active');
          },
          onLeaveBack: () => {
            section.classList.remove('active');
          },
          onComplete: () => {
            const nextIndex = index + 1;
            if (nextIndex < techFeaturesSections.length) {
              const nextSection = techFeaturesSections[nextIndex];
              nextSection.classList.add('active');
              gsap.to(window, { scrollTo: nextSection, duration: 0.5 });
              ScrollTrigger.refresh();
            }
          }
        }
      });
    });
  }


  initScrollTrigger();

  viewMoreLink.addEventListener('click', function (event) {
    event.preventDefault();

    hiddenFeatures.forEach(feature => {
      feature.classList.toggle('hidden');
    });


    updateLastVisibleFeature();


    ScrollTrigger.refresh();

    if (isViewMore) {
      viewMoreLink.textContent = 'View Less';
    } else {
      viewMoreLink.textContent = 'View More';
    }
    isViewMore = !isViewMore;
  });

  window.addEventListener('resize', function () {
    ScrollTrigger.getAll().forEach(trigger => trigger.kill());
    initScrollTrigger();
  });

  updateLastVisibleFeature();
});


//marquee

if (window.innerWidth <= 991) {
  var copy = document.querySelector(".logos-slide").cloneNode(true);
  document.querySelector(".logos").appendChild(copy);
}


document.addEventListener("DOMContentLoaded", function () {
  var clientsImg = document.querySelector(".clients-img");
  var images = clientsImg.innerHTML;
  clientsImg.innerHTML += images; // Append a copy of the images
});

//marquee
$(document).ready(function () {
  const clientsImg = $('.clients-img');
  const clone = clientsImg.html();
  clientsImg.append(clone);

  function continuousMarquee() {
    const scrollWidth = clientsImg[0].scrollWidth;
    clientsImg.css('transform', 'translateX(0)');
    clientsImg.animate(
      { transform: `translateX(-${scrollWidth}px)` },
      scrollWidth * 10, // Adjust speed as needed
      'linear',
      continuousMarquee
    );
  }

  continuousMarquee();
});

