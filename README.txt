COMPSCI 4WW3 Project MuseuMaster

Course: COMPSCI 4WW3

Term: 2021 Fall

Group Name: A&Z

Group Members:
1). Zoe Ning, ningh4, 400183343
2). Abdullah AbdulMaksoud, abdulmaa, 400205373

Links: https://zoe0709.github.io

Note: Group members Zoe and Abdullah are 4WW3 students. Add-on tasks 1 and 2 are both implemented.



Add-on Task 2d Answers:

1. Describe briefly the different versions of graphics provided in step 2(a); include a sample of HTML code and explain how the different selectors work together.

Three source images are included to response to different width of screens. When the browser width is at least 600px, high resolution image logo-180x180.png is used. If the width is between 450px and 600px, either logo-32x32.png or logo-16x16.png shows up depending on the device resolution. For those width less than 450px, img element is offered.

Code from index.html: 
	<picture>
	    <source type="image/png" media="(min-width: 600px)" srcset="./img/logo-180x180.png">
	    <source type="image/png" media="(min-width: 450px)" srcset="./img/logo-16x16.png 1x, ./img/logo-32x32.png 2x">
	    <img src="./img/logo-16x16.png" alt="Museum Logo" style="width:auto;">
	</picture>

The <picture> element contains several child <source> elements and one <img> element to find the image that best fits the current screen to display. Each <source> element has a media attribute that defines minimum width restriction, and a srcset attribute referring to different images through it. <img> element is the default option if none of the source elements are suitable for current device. 


2. List three positive goals that can be achieved using HTML5 <picture> and<source> attributes.

1). Save bandwidth through avoiding loading large images on a small device. The <media> attribute declares minimum width condition so that your browser can choose a proper <source> element.
2). Image format match. Image of supported format responses to the your browser, meanwhile, others stay silent. 
3). Optimize image viewing experience. Users' requirements for viewing images on different devices are different. Images satisfying distinct requirements can display correspondingly.


3. List one negative about using HTML5 <picture> and <source> attributes.  How can this negative be mitigated?

Consume more time, work, and storage. Images that only differ in resolution tend to occupy more storage. For those who prepare only one image, the use of <picture> tag is meaningless. Or it would take more time and work to generate same images with different resolutions. Similarly, browsers that do not support it receive nothing but a few more lines of code.   

To mitigate the negative, you can apply helper like auto image generators, or convert image format (WebP for example) appropriately. Solutions above will help save your resources.



Above and Beyond:

1). Built using vanilla css and html (No frameworks were used). 

2). Animation: We made use of css animations for form elements. When the form element is activated, the border smoothly increases by a factor of 3.

3). Processing form elements real time using css; for example, a user will not be able to sign up without filling the required fields (such as username or password). Furthermore, the email field will not accept an input that doesn’t contain the ‘@’ character and will notify the user.

4). One can search for museums either by name or by rating.

5). Extensive comments added throughout the project files.

6). Design is consistent, responsive, and fits the topic of history. 



Website Guide:

An index file is added as the home page of website, and a sign in page for logging in. 
To reach search page, submission page and registration page, please use the navigation bar on the top. 
Simply click search buttons in search page to see sample results page. 
Rows in the result table contain links to individual sample page.



Resources Used:

1). HTML5
2). Vanilla CSS
3). Google Fonts Material Icons
4). Google Lighthouse
5). VS Code (IDE)
6). Sublime Text
7). GitHub
8). Amazon Web Services 
9). Microsoft Teams
10). Slack
11). Windows 10, Mac OS



References:

1). Aga Khan museum. (n.d.). Retrieved from https://www.agakhanmuseum.org/index.html 
2). Ontario Yours To Discover. (n.d.). Aga Khan Museum. Destination Ontario. Retrieved from https://www.destinationontario.com/en-ca/aga-khan-museum
3). Ontario Yours To Discover. (n.d.). Bata Shoe Museum. Destination Ontario. Retrieved from https://www.destinationontario.com/en-ca/bata-shoe-museum
4). Ontario Yours To Discover. (n.d.). Canadian Automotive Museum. Destination Ontario. Retrieved from https://www.destinationontario.com/en-ca/canadian-automotive-museum
5). A Museum Like No Other. (2017b, July 27). [Video]. YouTube. https://www.youtube.com/watch?v=PDQ3QsjLfEM






