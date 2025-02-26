<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Guidance</title>
        <link rel="stylesheet" href="../CSS/MStyle.css"> 
        <link rel="stylesheet" href="../CSS/BStyle.css"> 
        <link rel="stylesheet" href="../CSS/FStyle.css"> 
        <link rel="stylesheet" href="../CSS/RStyle.css"> 

        <!-- âœ… Import Swiper CSS -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/htmx/1.9.12/htmx.min.js"></script>

        <style>
  /* âœ… Future-Ready Section */
.future-ready-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 50px;
    max-width: 1200px;
    margin: auto;
}

.text-content {
    width: 50%;
    font-family: 'Poppins', sans-serif;
}

.text-content h2 {
    font-size: 30px;
    font-weight: bold;
    color: #1a3c80;
    margin-top: 10px;
}

.text-content p {
    font-size: 18px;
    color: #333;
    line-height: 1.6;
    margin-top: -20px;
}

/* âœ… Slideshow Container */
.image-container {
    position: relative;
    width: 400px; /* Maintain your preferred image size */
    height: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

/* âœ… Slides */
.slide {
    display: none;
}

.slide img {
    width: 100%;
    border-radius: 15px;
}

/* âœ… Navigation Buttons */
.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    font-size: 24px;
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
    user-select: none;
}

.prev {
    left: 10px;
}

.next {
    right: 10px;
}

/* âœ… Fade Animation */
.fade {
    animation: fadeEffect 1s ease-in-out;
}

@keyframes fadeEffect {
    from { opacity: 0.4; }
    to { opacity: 1; }
}

/* âœ… News layout */
body {
    font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: none;
            
        }
        .container {
            width: 100%;
            margin: 20px;
            background: white;
            padding: 30px;
            margin-top:-40px;
            width:-150px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
          
        }
        .header {
            font-size: 22px;
            font-weight: bold;
            color: #1a3c80;
            margin-bottom: 10px;
            
        }
        .news-section {
            display: flex;
            gap: 20px;
            
        }
        .main-news {
            flex: 2;
           
        }
        .main-news img {
            width: 85%;
            height: auto;
            border-radius: 5px;
            border: 1px solid #ccc; /* Light gray border */
            padding:8px;

            
        }
        .main-news h3 {
            margin: 10px 0;
color: #1a3c80;
        }
        .side-news {
            flex: 1;
        }
        .side-news .news-item {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .side-news img {
    width: 100px; /* Adjust size as needed */
    height: 80px;
    border-radius: 5px;
    object-fit: cover;
    border: 1px solid #ccc; /* Light gray border */
    padding: 5px; /* Space between image and border */
    background: white; /* Optional: Adds background to the border */

}
        .side-news .text {
            flex: 1;
        }
        .news-date {
            font-size: 12px;
            color: gray;
        }
        .news-title {
            font-weight: bold;
            font-size: 14px;
        }
        .more-news {
            display: block;
            text-align: center;
            background: #1a3c80;
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }

/* Section Container */
.scroll-section {
    text-align: center;
    margin-bottom: 20px;
}

/* Title Styling */
.scroll-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
    text-transform: uppercase;
}
.scroll-container {
    width: 95%;
    overflow-x: hidden; /* Hides the scrollbar */
    white-space: nowrap; /* Prevents wrapping */
    margin: auto;
    border-radius: 10px;
    cursor: grab;
    position: relative;
    box-shadow: none;
    display: block; /* Ensure no flexbox */
    object-fit: cover; /* Prevents stretching */
    scrollbar-width: none; /* For Firefox */
    -ms-overflow-style: none; /* For Internet Explorer/Edge */
}

.scroll-container::-webkit-scrollbar {
    display: none; /* For Chrome, Safari, and Opera */
}

/* Individual Scroll Items */
.scroll-item {
    display: inline-block; /* Align items horizontally */
    width: 300px; /* Ensure consistent width */
    text-align: center;
    background: white;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    padding: 10px;
    margin-right: 15px; /* Space between items */
    overflow: hidden; /* Prevents content overflow */
}

/* Image inside Scroll Item */
.scroll-item img {
    width: 100%;
    height: 200px;
    max-height: 200px; /* Prevents stretching */
    border-radius: 10px;
    object-fit: cover; /* Maintains aspect ratio */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

/* Caption Styling */
.caption {
    background: none;
    color: white;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    margin-top: 5px;
}

.caption h3 {
    font-size: 16px;
    margin: 5px 0;
    color: #1a3c80;
}

.caption p {
    font-size: 14px;
    margin: 0;
    color: #1a3c80;
}

/* Button Container */
.button-container {
    text-align: center;
    margin-top: 20px;
}

/* View More Button */
.view-more-btn {
    background-color: #1a3c80;
    color: white;
    font-size: 16px;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.view-more-btn:hover {
    background-color: #0f295a;
}

/* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color:none;
}

/* Main Layout */
.main-container {
    display: flex;
    max-width: 1200px;
    margin: auto;
    padding: 20px;
    gap: 20px;
}

/* Sidebar (Both Left & Right) */
.sidebar {
    width: 150px;
    max-height: 600px; /* ðŸ”¹ Limitahan ang taas ng sidebar */
    overflow-y: auto; /* ðŸ”¹ Mag-scroll kung lumagpas sa max-height */
    background: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);

}

.sidebar h2 {
    font-size: 18px;
    font-weight: bold;
    display: flex;
    align-items: center;
}

.green-bar {
    width: 5px;
    height: 20px;
    background: green;
    display: inline-block;
    margin-right: 10px;
}

/* SideNews List */
.sidenews-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidenews-list li {
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
}

.sidenews-list li:last-child {
    border-bottom: none;
}

.category {
    color: #0073e6; /* Kulay Blue */
    font-weight: bold;
    text-decoration: none;
}

.category:hover {
    text-decoration: underline;
    color: #005bb5; /* Darker Blue kapag hover */
}


.sidenews-title {
    font-size: 14px;
    color: #333;
}

.time {
    font-size: 12px;
    color: gray;
}

/* Play Icon */
.play-icon {
    color: black;
    font-size: 12px;
    margin-right: 5px;
}

/* Main Content */
.content {
    flex: 1;
    background: white;
    padding: 20px;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.content {
    text-align: center;
    padding: 15px;
}
.video-container {
    text-align: center;
    background: #fff;
    padding: 15px;
    max-width: 600px; /* â¬… Mas maliit na width */
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.video-container iframe {
    width: 100%;
    max-width: 560px; /* â¬… Adjusted width */
    height: 315px; /* â¬… Adjusted height */
    border-radius: 10px;
}


.view-more-btn {
    background-color: #1a3c80;
    color: white;
    font-size: 16px;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 15px;
}

.view-more-btn:hover {
    background-color: #0f295a;
}
/* Video Title */
.video-title {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 10px;
}

/* Video Description */
.video-description {
    font-size: 16px;
    color: #555;
    margin-bottom: 15px;
}

/* Video */
.video-container video  {
    background: #fff;
    padding: 20px;
    max-width: 600px;
    margin: 0 auto; /* Center the video */
    width: 85%;
            height: auto;
            border-radius: 5px;
            border: 1px solid #ccc; /* Light gray border */
}

/* More Videos Button */
.more-videos-btn {
    background-color: #1a3c80;
    color: white;
    font-size: 16px;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.more-videos-btn:hover {
    background-color: #0056b3;
}

        </style>
    </head>
    <body>
        <header>
            <div class="LContainer">
                <a id="logoLink" href="../HTMLphp/Redirect.html" onclick="return false;">
                    <img src="../CSS/2.png" alt="Logo" class="Logo">
                </a>
                <div class="LText">
                    <h4 class="LsText">Guidance</h4>
                    <p class="pLText">AU Jose Rizal Campus</p>
                </div>
                <div>
                    <h2 class="CurrentPage">Resources</h2>
                </div>
            </div>
        </header>
        
        <main class="CBody">
            <div class="Info">
             
            </div>
            <div class="button-container">
                <ul class="button-list">
                    <li><a href="HOME.php"><button>Home</button></a></li>
                    <li><a href="news.php"><button>News & Resources</button></a></li>
                    <li><a href="resources.php"><button>Student Services</button></a></li>
                    <li><a href="Report.php"><button>Consultation</button></a></li>
                </ul>   
            </div>
        </main>

        <div class="Bg">
            <img src="../IMG/au-malabon-rizal.jpg" alt="Background Image">
        </div>

        <article class="AUart">
            <div style="display: flex; align-items: center; background: rgb(48, 59, 178); width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <img src="../CSS/LogoAU.png" alt="Logo" style="width: 120px; height: auto; margin-right: 15px;">
                <h2 style="color: white; margin: 0; font-size: 3.2em; font-family: 'Poppins', sans-serif; font-weight: bold; letter-spacing: 1px;">
                    Guidance Office of AU JRC
                </h2>
            </div>

     <!-- âœ… Future-Ready Learning Section -->
<section class="future-ready-section">
    <div class="text-content">
        <h2>Guidance & Beyond</h2>
        <p>
            The Guidance Office, together with the Office of Student Affairs and the Prefect of Discipline, 
            plays a crucial role in ensuring students' holistic development. While the Guidance Office focuses 
            on emotional, academic, and career support, the OSA enhances student engagement through 
            extracurricular activities, and the Prefect of Discipline maintains order and instills values. 
            Their combined efforts contribute to a positive and supportive learning environment for all students.
        </p>
    </div>

    <!-- âœ… Slideshow Container -->
    <div class="image-container slideshow-container">
        <!-- Slide 1 -->
        <div class="slide fade">
            <img src="../Pics/news.jpg" alt="News 1">
        </div>

        <!-- Slide 2 -->
        <div class="slide fade">
            <img src="../Pics/n.jpg" alt="News 2">
        </div>

        <!-- Slide 3 -->
        <div class="slide fade">
            <img src="../Pics/e.jpg" alt="News 3">
        </div>

         <!-- Slide 4 -->
         <div class="slide fade">
            <img src="../Pics/w.jpg" alt="News 4">
        </div>

         <!-- Slide 5 -->
         <div class="slide fade">
            <img src="../Pics/ws.jpg" alt="News 5">
        </div>

        <!-- Slide 6 -->
        <div class="slide fade">
            <img src="../Pics/wss.png" alt="News 6">
        </div>

        <!-- Left & Right Navigation Buttons -->
        <a class="prev" onclick="moveSlide(-1)">â®</a>
        <a class="next" onclick="moveSlide(1)">â¯</a>
    </div>
</section>

<div class="container">
        <div class="header">AUJRC News & Highlights</div>
        <div class="news-section">
            <div class="main-news">
                <img src="../Pics/news1.jpg" alt="Main News">
                <h3> The Seminar â€œTeamwork makes the dream workâ€ of SSC.</h3>
                <p>It was held at the Senior High School Library, February 17, 2025, fostering a day of collaboration, leadership, and teamwork among senior high school students.</p>
            </div>
            <div class="side-news">
                <div class="news-item">
                    <img src="../Pics/news2.jpg" alt="News 2">
                    <div class="text">
                        <div class="news-date">JULY 8, 2024</div>
                        <div class="news-title"><a href="https://www.facebook.com/AUJRCTheStandard/posts/pfbid0iwJ5Ty1RyiSS7AGSDqo5csD26uzSRspZpWxWESiPSiq9p9k5pTXoGEmkXDBjQwMPl">Annual Family Day today</a></div>
                    </div>
                </div>
                <div class="news-item">
                    <img src="../Pics/news3.jpg" alt="News 3">
                    <div class="text">
                        <div class="news-date">JULY 8, 2024</div>
                        <div class="news-title"><a href="https://www.facebook.com/AUJRCTheStandard/posts/pfbid0EYJEpmVP5WcpBj9kocuTYZ8z1yjy1Wewkh7jU8GK6jr6ypsntASE6wieZm9hbC34l">HUMSS's Vibrant Celebration of Filipino Heritage</a></div>
                    </div>
                </div>
                <div class="news-item">
                    <img src="../Pics/news4.jpg" alt="News 4">
                    <div class="text">
                        <div class="news-date">JUNE 25, 2024</div>
                        <div class="news-title"><a href="https://www.facebook.com/AUJRCTheStandard/posts/pfbid0241hk6RsH8ahcitRuwLtKksG3F6A8VnHXmbRuuou5Q57ezrRHxVAKmzP1zWZZWBczl">Little Dreamers</a></div>
                    </div>
                </div>
                <div class="news-item">
                    <img src="../Pics/news5.jpg" alt="News 5">
                    <div class="text">
                        <div class="news-date">JUNE 10, 2024</div>
                        <div class="news-title"><a href="https://www.facebook.com/AUJRCTheStandard/posts/pfbid029NHpc51d1rdVKZD4JzpU3A6BMHb9rCjEh9JpA2JDvAcJ5MZwLFwbaUu8n5DYWKQl">A Night of Pageantry</a></div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="more-news">More Campus News</a>
    </div>
</body>
</html>


<div class="scroll-section">
    <h2 class="scroll-title">Latest News & Updates</h2> <!-- âœ… Title sa Itaas -->

    <div class="scroll-container">
        <div class="scroll-content">
        <div class="scroll-item">
            <a href="https://www.philstar.com/lifestyle/health-and-family/2024/11/05/2395223/filipino-youth-and-mental-health-are-we-listening-enough-heads-ph-advocates-awareness-support" target="_blank">
                <img src="../Pics/unilab.png" alt="unilab">
            </a>
            <div class="caption">
                <h3>Mental health landscape</h3>
                <p>Unilab Foundation has started scaling up its implementation of Heads Up PH</p>
            </div>
            </div>

            <div class="scroll-item">
            <a href="https://pia.gov.ph/philhealth-alaga-ka-campaign-konsulta-gindara-sa-banwa-ka-bugasong/" target="_blank">
                <img src="../Pics/konsulta.jpg" alt="unilab">
            </a>
            <div class="caption">
                <h3>PhilHealth AlaGa Ka Campaign</h3>
                <p>Libreng Konsulta</p>
            </div>
            </div>

            <div class="scroll-item">
            <a href="https://www.abs-cbn.com/spotlight/12/02/22/suicide-calls-and-compassion-fatigue-life-as-crisis-line-responders" target="_blank">
                <img src="../Pics/worldmental.jpg" alt="world">
            </a>
            <div class="caption">
                <h3>World Mental Health </h3>
                <p>Life as crisis line responders</p>
            </div>
            </div>

            <div class="scroll-item">
            <a href="https://www.abs-cbn.com/news/nation/2025/2/25/zero-government-subsidy-for-philhealth-questioned-at-the-supreme-court-1205" target="_blank">
                <img src="../Pics/philhealth.jpg" alt="health">
            </a>
            <div class="caption">
                <h3>Zero government subsidy</h3>
                <p>Philhealth questioned the Supreme Court for the Zero Subsidy</p>
            </div>
            </div>

            <div class="scroll-item">
            <a href="https://www.facebook.com/abscbnNEWS/photos/the-department-of-health-launches-nationwide-campaign-to-combat-the-spread-of-de/1099939215514667/?_rdr" target="_blank">
                <img src="../Pics/dengue.jpg" alt="health">
            </a>
            <div class="caption">
                <h3>DOH launches a nationwide campaign</h3>
                <p>Combat the spread of dengue with DOH's campaign</p>
            </div>
            </div>

            <div class="scroll-item">
            <a href="https://www.facebook.com/gmanews/posts/more-college-students-cited-mental-health-issues-as-a-reason-for-dropping-out-mo/977195167785474/" target="_blank">
                <img src="../Pics/dropout.jpg" alt="health">
            </a>
            <div class="caption">
                <h3>Increasing Dropout Rate</h3>
                <p>More college students cited mental health issues as a reason for dropping out</p>
            </div>
            </div>

            <div class="scroll-item">
            <a href="https://www.gmanetwork.com/news/lifestyle/healthandwellness/923137/5-filipino-realities-that-harm-our-well-being-and-what-we-can-do-about-them/story/" target="_blank">
                <img src="../Pics/reality.jpg" alt="reality">
            </a>
            <div class="caption">
                <h3>5 Filipino realities</h3>
                <p>Realities that harm our well-being and what we can do about them</p>
            </div>
            </div>


            </div>
        </div>
      <!-- âœ… Add More News Button -->
      <div class="button-container">
        <button class="view-more-btn">View More News</button>
    </div>
</div>


<div class="main-container">
    <!-- Left Sidebar -->
    <aside class="sidebar">
        <h2><span class="navy-blue"></span> Latest Articles</h2>
        <ul class="sidenews-list">
            <li>
                <a href="https://www.rcoz.us/breaking-down-mental-health-misconceptions-what-is-the-real-truth/?gad_source=1&gclid=Cj0KCQiA_NC9BhCkARIsABSnSTY3ElffeNbnIl3kzwDDK8OgdvHaEoPVz_eEt12DB8JT0CjEY_4MjfEaAviQEALw_wcB" 
                   class="category" target="_blank" rel="noopener noreferrer">Real Truth</a>
                <p class="sidenews-title">Breaking Down Mental Health Misconceptions: What is the Real Truth?</p>
                <span class="time">10 minutes ago</span>
            </li>
            <li>
                <a href="https://www.nature.com/articles/d41586-021-02690-5" class="category" target="_blank" rel="noopener noreferrer">Young people</a>
                <p class="sidenews-title"><span class="play-icon"></span> Young peopleâ€™s mental health is finally getting the attention it needs</p>
                <span class="time">17 minutes ago</span>
            </li>
            <li>
                <a href="https://www.apa.org/monitor/2022/10/child-anxiety-treatment" class="category" target="_blank" rel="noopener noreferrer">Anxiety</a>
                <p class="sidenews-title">Anxiety among kids is on the rise. Wider access to CBT may provide needed solutions</p>
                <span class="time">24 minutes ago</span>
            </li>
            <li>
                <a href="https://www.who.int/publications/i/item/9789240031029" class="category" target="_blank" rel="noopener noreferrer">Action Plan</a>
                <p class="sidenews-title">Builds upon its predecessor and sets out clear actions for Member States to promote mental health</p>
                <span class="time">26 minutes ago</span>
            </li>
        </ul>
    </aside>

  <!-- Video Container -->
<div class="video-container">
    <h2>Mind Unlocked: Stories, Strategies, and Serenity</h2>
    <p>Watch this insightful video about mental health and well-being.</p>

    <!-- YouTube Embed -->
    <iframe width="853" height="480" 
        src="https://www.youtube.com/embed/tX8TgVR33KM" 
        title="Check in on those around you | #WorldMentalHealthDay ðŸ’›ðŸ’š #youarenotalone" 
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        referrerpolicy="strict-origin-when-cross-origin" 
        allowfullscreen>
    </iframe>

    <!-- More Videos Button -->
    <div class="button-container">
        <button class="view-more-btn" onclick="window.location.href='https://www.youtube.com/c/yourchannel'">
            More Videos
        </button>
    </div>
</div>
</main>
    <!-- Right Sidebar (Duplicate of Left Sidebar) -->
    <aside class="sidebar">
        <h2><span class="navy-blue"></span> Latest Articles</h2>
        <ul class="sidenews-list">
            <li>
                <a href="https://www.mentalhealth.org.uk/explore-mental-health/kindness-and-mental-health/random-acts-kindness" class="category" target="_blank" rel="noopener noreferrer">Kindness</a>
                <p class="sidenews-title">Helping others can be good for our mental health. It reduces stress, improves our emotional well-being and even benefits our physical health. In short, doing good does you good. </p>
                <span class="time">10 minutes ago</span>
            </li>
            <li>
                <a href="https://www.mentalhealth.org.uk/explore-mental-health/articles/what-advice-would-you-give-someone-lacking-motivation" class="category" target="_blank" rel="noopener noreferrer">Advice</a>
                <p class="sidenews-title"><span class="play-icon"></span> What advice would you give to someone lacking in motivation?</p>
                <span class="time">17 minutes ago</span>
            </li>
            <li>
                <a href="https://www.mentalhealth.org.uk/explore-mental-health/loneliness/help-and-advice" class="category" target="_blank" rel="noopener noreferrer">Loneliness</a>
                <p class="sidenews-title">Loneliness help and advice</p>
                <span class="time">24 minutes ago</span>
            </li>
            <li>
                <a href="https://www.mentalhealth.org.uk/our-work/public-engagement/suicide-prevention" class="category" target="_blank" rel="noopener noreferrer">Prevention</a>
                <p class="sidenews-title">Read our advice on how to talk to someone about suicide and help them get the right support. </p>
                <span class="time">26 minutes ago</span>
            </li>
        </ul>
    </aside>
</div>



</body>
</html>


</body>
</html>
</script>


</body>
</html>

<script>
    let slideIndex = 0;
    let slides = document.getElementsByClassName("slide");

    function showSlides(n) {
        if (n >= slides.length) { 
            slideIndex = 0;  
        }  
        if (n < 0) { 
            slideIndex = slides.length - 1;  
        }

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[slideIndex].style.display = "block"; 
    }

    function moveSlide(n) {
        slideIndex += n;
        showSlides(slideIndex);
    }

    // âœ… Auto-slide every 60 seconds
    function autoSlide() {
        moveSlide(1);
        setTimeout(autoSlide, 60000); // 60 seconds
    }

    // âœ… Ipakita agad ang unang slide
    showSlides(slideIndex);

    // âœ… Simulan ang auto-slideshow
    setTimeout(autoSlide, 60000);
</script>
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const scrollContainer = document.querySelector(".scroll-container");

        if (!scrollContainer) {
            console.error("Error: Walang .scroll-container na nakita.");
            return;
        }

        let isDown = false;
        let startX;
        let scrollLeft;

        scrollContainer.addEventListener("mousedown", (e) => {
            isDown = true;
            scrollContainer.classList.add("active");
            startX = e.pageX - scrollContainer.offsetLeft;
            scrollLeft = scrollContainer.scrollLeft;
        });

        scrollContainer.addEventListener("mouseleave", () => {
            isDown = false;
            scrollContainer.classList.remove("active");
        });

        scrollContainer.addEventListener("mouseup", () => {
            isDown = false;
            scrollContainer.classList.remove("active");
        });

        scrollContainer.addEventListener("mousemove", (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - scrollContainer.offsetLeft;
            const walk = (x - startX) * 2; // Adjust speed
            scrollContainer.scrollLeft = scrollLeft - walk;
        });
    });
</script>


</body>
</html>

</body>
</html>

</main>
            </a>
        </li>
    </ul>
</div>

</div>
    </section>
</article>

        <main class="Footer">
            <div class="FContainer" style="display: flex; flex-direction: column; align-items: center; text-align: center; padding: 1px;">
                <div class="middle-section">
                    <a id="logolink" href="https://www.arellano.edu.ph/" class="AUOS">
                        <img src="../CSS/LogoAU.png" alt="Logo" class="AU" style="width: 100px; height: auto; display: block; margin: 0 auto;">
                    </a>
                </div>
                <div class="contact-section" style="font-size: 14px; margin-top: 8px; font-weight: normal; color: #FFFFFF;">
                    <p>
                        <i class="fa-solid fa-location-dot" style="font-size: 16px;"></i> Concepcion, Malabon City &nbsp; | &nbsp;
                        <i class="fa-brands fa-facebook" style="font-size: 16px;"></i> 
                        <a href="https://www.facebook.com/aujoserizal" target="_blank" style="color: #FFFFFF; text-decoration: none;">Facebook</a> &nbsp; | &nbsp;
                        <i class="fa-solid fa-phone" style="font-size: 16px;"></i> 8-921-2744 (Principal's Office) &nbsp; | &nbsp;
                        <i class="fa-solid fa-envelope" style="font-size: 16px;"></i> hs.joserizal@arellano.edu.ph
                    </p>
                </div>
            </div>
        </main>

        <!-- âœ… Import Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.swiper', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true, // Allows the dots to be clickable
                },
            });
        </script>
    </body>
</html>
