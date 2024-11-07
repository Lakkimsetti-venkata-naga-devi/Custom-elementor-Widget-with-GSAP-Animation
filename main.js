<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
<script>
	var vww = jQuery(window).width();
if(vww > 767){
	gsap.registerPlugin(ScrollTrigger);

	gsap.set(".panel", { zIndex: (i, target, targets) => targets.length - i });

	var images = gsap.utils.toArray('.panel:not(:last-child)');

	images.forEach((image, i) => {

		var tl = gsap.timeline({

			scrollTrigger: {
				trigger: "section.black",
				start: () => "top -" + (window.innerHeight*(i+0.5)),
				end: () => "+=" + window.innerHeight,
				scrub: true,
				toggleActions: "play none reverse none",
				invalidateOnRefresh: true,     
			}

		})

		tl
		.to(image, { height: 0 })
		;

	});

	gsap.set(".panel-text", { zIndex: (i, target, targets) => targets.length - i });

	var texts = gsap.utils.toArray('.panel-text');

	texts.forEach((text, i) => {

		var tl = gsap.timeline({

			scrollTrigger: {
				trigger: "section.black",
				start: () => "top -" + (window.innerHeight*i),
				end: () => "+=" + window.innerHeight,
				scrub: true,
				toggleActions: "play none reverse none",
				invalidateOnRefresh: true,     
			}

		})

		tl
		.to(text, { duration: 0.33, opacity: 1, y:"0%" })  
		.to(text, { duration: 0.33, opacity: 0, y:"0%" }, 0.66)
		;

	});

	ScrollTrigger.create({

			trigger: "section.black",
			scrub: false,
			markers: false,
			pin: true,
			start: () => "top top",
			end: () => "+=" + ((images.length + 1) * window.innerHeight),
			invalidateOnRefresh: true,

	});
}
</script>
