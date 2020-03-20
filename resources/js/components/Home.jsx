import React from 'react';
import ReactDOM from 'react-dom';

import Header from './partials/Header';
import Footer from './partials/Footer'


const Home = () => {

    function emailDisplay(){
        var email_element = document.getElementById("tooltiptext_email");
        email_element.classList.toggle("tooltiptext_reveal");
    }
      

    return (
        <div>
            <Header/>
            
            <div id="mainContent" className="main_content">


    <div className="landingPage">
              <h1 className="landingPage_title">Art Portfolio</h1>
            <div className="landingpage_text">

        <p>This is my portfolio, where you will find my artwork, which includes concept art, photography, 3D modelling, animations and more.</p>      </div>
    </div>


    <div className="homePageSectionBk">
      <div className="homePageSection">

        <h2 className="SectionTitle">Explore</h2>
        <div className="mainLinksSection">
          <a href="list_albums.php" className="mainLinksSection_div">
            <h2>View Albums</h2>
            <p>Click here to explore all of my albums</p>
    
            <i className="fas fa-folder-open"></i>
          </a>

          <a href="list_posts.php" className="mainLinksSection_div">
            <h2>View All Posts</h2>
            <p>Click here to explore all of my posts</p>
    
            <i className="fas fa-images"></i>
          </a>
        </div>

        

        <h2 className="SectionTitle">Recent Uploads</h2>
          <div className="featuredImages recentPosts">
            <div className="miniGallery">
                                <a style={{"backgroundImage:" : " url('img/uploads/image.5e740cac5a93b5.27426162.png');"}} className="image_link" href="single.php?post=137">
                    <div className="filter">
                       <h2 className="name"> Unity Platform Game Course </h2>   </div></a>                  <a style={{"backgroundImage:" : " url('img/uploads/image.5e740cac5a93b5.27426162.png');"}}  className="image_link" href="single.php?post=136">
                    <div className="filter">
                       <h2 className="name"> Garden 3 </h2>   </div></a>                  <a style={{"backgroundImage:" : " url('img/uploads/image.5e740cac5a93b5.27426162.png');"}}  className="image_link" href="single.php?post=135">
                    <div className="filter">
                       <h2 className="name"> Garden 2 </h2>   </div></a>                  <a style={{"backgroundImage:" : " url('img/uploads/image.5e740cac5a93b5.27426162.png');"}}  className="image_link" href="single.php?post=134">
                    <div className="filter">
                       <h2 className="name"> Garden 4 </h2>   </div></a>                  <a style={{"backgroundImage:" : " url('img/uploads/image.5e740cac5a93b5.27426162.png');"}}  className="image_link" href="single.php?post=133">
                    <div className="filter">
                       <h2 className="name"> Garden 2 </h2>   </div></a>                  <a style={{"backgroundImage:" : " url('img/uploads/image.5e740cac5a93b5.27426162.png');"}}  className="image_link" href="single.php?post=131">
                    <div className="filter">
                       <h2 className="name"> Office  </h2>   </div></a>
                </div>
              </div>
              <a className="viewMoreBtn" href="list_posts.php">View More...</a>
            
                          <h2 className="SectionTitle ">About Me</h2>
              <div className="aboutSection">
                <img src='/img/pref/profilePic.jpeg' alt="Hey look it me" />
                <p>I am a 19-year-old Art and Design student at Bedford College. In the future I hope to study an digital media related to field at university in the future.  </p>

              </div>




 
            <span id="tooltiptext_email" className="tooltiptext">astra.london24@gmail.com</span>

            <div className="endSection">

              
                                  <button onClick={() => emailDisplay()} type="button" className="social_button social_button_email" name="button"><i className="fas fa-envelope"></i></button>
                
                                </div>


                <Footer></Footer>




              </div>

            </div>

          </div>
        </div>
    );
}

export default Home;
