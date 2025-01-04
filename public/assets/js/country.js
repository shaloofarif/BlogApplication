window.addEventListener('load', () => {
	let homeLocationText = document.querySelector('#homeLocationText');
	let aboutBannerLocationText = document.querySelector('#aboutBannerLocationText');
	let aboutLocationText = document.querySelector('#aboutLocationText');

	fetch('https://ipapi.co/json/')
		.then((response) => response.json())
		.then((data) => {
			if (data.country_name !== 'Saudi Arabia') return;

			if (homeLocationText) {
				homeLocationText.innerHTML = `Transforming GRC with Saudi Innovation, Embrace the Future of Compliance and Risk Management.`;
			}

			if (aboutBannerLocationText) {
				homeLocationText.innerHTML = `Saudi Innovative GRC and Technology Solutions.`;
			}

			if (aboutLocationText) {
				homeLocationText.innerHTML = `Jethur is a cutting-edge Saudi-made software solution, designed to enhance business performance through innovative approaches to Governance, Risk and Compliance (GRC). Our solution empowers businesses to streamline complex processes, boost operational effectiveness, and ensure Compliance with regulations.`;
			}
		})
		.catch((error) => console.error('Error:', error));
});
