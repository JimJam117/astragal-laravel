import React, {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';
import {Link} from 'react-router-dom';

import Header from './partials/Header';
import Footer from './partials/Footer';
import Loading from './partials/Loading';

const Home = () => {

    function emailDisplay() {
        var email_element = document.getElementById("tooltiptext_email");
        email_element
            .classList
            .toggle("tooltiptext_reveal");
    }

    const [state,
        setState] = useState({});
    const [pref,
        setPref] = useState({});
    const [loading,
        setLoading] = useState(true);

    const fetchItems = async() => {
        await fetch('/api/post').then((response) => {
            return response.json();
        }).then((data) => {
            setState(data);
            fetch('/api/pref').then((response) => {
                return response.json();
            }).then((data) => {
                setPref(data);
                setLoading(false);
            });
        });
    }

    useEffect(() => {
        loading
            ? fetchItems()
            : null;
    });

    return (
        <div>
            <Header/>

            <div id="mainContent" className="main_content">
                {loading
                    ? <Loading/>
                    : <div>
                        <div className="landingPage">
                            <h1 className="landingPage_title">{pref.landing_page_title}</h1>
                            <div className="landingpage_text">
                                <p>{pref.landing_page_text}</p>
                            </div>
                        </div>

                        <div className="homePageSectionBk">
                            <div className="homePageSection">

                                <h2 className="SectionTitle">Explore</h2>
                                <div className="mainLinksSection">
                                    <Link to="/albums" className="mainLinksSection_div">
                                        <h2>View Albums</h2>
                                        <p>Click here to explore all of my albums</p>

                                        <i className="fas fa-folder-open"></i>
                                    </Link>

                                    <Link to="posts" className="mainLinksSection_div">
                                        <h2>View All Posts</h2>
                                        <p>Click here to explore all of my posts</p>

                                        <i className="fas fa-images"></i>
                                    </Link>
                                </div>

                                {state.posts.length > 0
                                    ? <div>
                                            <h2 className="SectionTitle">Recent Uploads</h2>
                                            <div className="featuredImages recentPosts">
                                                <div className="miniGallery">
                                                    {state
                                                        .posts
                                                        .map((post, i = 0) => {
                                                            if (i < 6) {
                                                                return (
                                                                    <Link
                                                                        style={{
                                                                        backgroundImage: `url('${post.image}')`
                                                                    }}
                                                                        className="image_link"
                                                                        to={`/post/${post.id}`}>
                                                                        <div className="filter">
                                                                            <h2 className="name">
                                                                                {post.title}
                                                                            </h2>
                                                                        </div>
                                                                    </Link>
                                                                )
                                                            }
                                                            i++;
                                                        })}
                                                </div>

                                            </div>
                                            <a className="viewMoreBtn" href="/posts">View More...</a>
                                        </div>
                                    : null}

                                <h2 className="SectionTitle ">About Me</h2>
                                <div className="aboutSection">
                                    <img src='/img/pref/profilePic.jpeg' alt="Hey look it me"/>
                                    <p>I am a 19-year-old Art and Design student at Bedford College. In the future I
                                        hope to study an digital media related to field at university in the future.
                                    </p>

                                </div>

                                <span id="tooltiptext_email" className="tooltiptext">astra.london24@gmail.com</span>

                                <div className="endSection">

                                    <button
                                        onClick={() => emailDisplay()}
                                        type="button"
                                        className="social_button social_button_email"
                                        name="button">
                                        <i className="fas fa-envelope"></i>
                                    </button>

                                </div>
                            </div>
                        </div>

                    </div>
}
                <Footer></Footer>
            </div>
        </div>
    );

}

export default Home;
