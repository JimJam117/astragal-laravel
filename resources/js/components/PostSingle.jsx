import React, {useState, useEffect} from 'react';
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";

import Header from './partials/Header'
import Footer from './partials/Footer'
import Loading from './partials/Loading'
import {Link} from 'react-router-dom'
import Slider from "react-slick";

import ReactHtmlParser from 'react-html-parser';

const PostSingle = (props) => {

    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;
    

    const [state, setState] = useState({});
    const [extraImages, setExtraImages] = useState({});
    const [loading, setLoading] = useState(true);
    const [isFetching,setIsFetching] = useState(false);

 
    const fetchItems = async (apiUrl = `/api/post/` + props.match.params.id) =>  {
        setIsFetching(true);
        await fetch(apiUrl, {signal})
            .then((response) => {

                //throw errors if issues
                if (response.status === 500) {
                    throw new Error("500");
                }
                else if(response.status === 404) {
                    throw new Error("404");
                }
                else if(response.status === 419) {
                    throw new Error("419");
                }
                else if(response.status === 429) {
                    throw new Error("429");
                }

                console.log(response);
                return response.json();

        }).then(data => {
            setState(data);

            return fetch('/api/post-images/' + props.match.params.id);
        }).then((response) => {

            //throw errors if issues
            if (response.status === 500) {
                throw new Error("500");
            }
            else if(response.status === 404) {
                throw new Error("404");
            }
            else if(response.status === 419) {
                throw new Error("419");
            }
            else if(response.status === 429) {
                throw new Error("429");
            }

            console.log(response);
            return response.json();
        }).then(imagesData => {
            setExtraImages(imagesData.images);
            setLoading(false);
            setIsFetching(false);

        })


        //err catch
        .catch((e) => {
            if (e.name !== "AbortError") {
                if (e.message === "404" || e.name === "TypeError") {
                    window.location.href = "/not-found";
                }
                else if (e.message === "500") {
                    window.location.href = "/server-error";
                }
                else if (e.message === "419") {
                    window.location.href = "/page-expired";
                }
                else if (e.message === "429") {
                    window.location.href = "/too-many-requests";
                }
            } 
        });
    }


    useEffect(() => {
        if(loading && !isFetching) {
            setTimeout(() => {
                setIsFetching(true);
                fetchItems();
            }, 2000);
        };
        return () => {
            if(isFetching){
                controller.abort();
                setIsFetching(false);
            }
        };
    }, [setIsFetching]);

    var settings = {
        className: 'slick-centered',
        arrows: true,
        dots: true,
        autoplay: true,
        autoplaySpeed: 6000,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        lazyLoad: true,
      };
  

    return (
        <div>
            <Header></Header>
        <div id="mainContent" className="main_content">
            
        {loading ? <Loading white={true} /> :
        <article className="single">
   
                {props.match.params.body}
                <div className="single_left">

                    {/* <!--IMAGE--> */}
                    <div className="single_image_container">
                    <Slider {...settings}>
                   <img className="postSingle_image" src={state.post.image} alt={state.post.title} />
                    {
                        extraImages.map(extraImage => {
                            return <img key={extraImage.id} src={extraImage.image}/>
                        })
                    }
                    </Slider>
                    </div>

                    {/* <!--LINK BUTTONS--> */}
                    <div className="single_links">
                    <a className="single_download" href={`${state.post.image}`} download><i className="fas fa-download"></i> Download</a>
                    <a className="single_viewfull" href={`${state.post.image}`} target="_blank"><i className="far fa-image"></i> View Full Size</a>

                    {/* <!--ABLUM BUTTON--> */}
                    {
                        state.post.category_id == 0 ? null :
                        <Link className="single_viewalbum" to={`/album/${state.post.category_id}`}><i className="far fa-images"></i> View Album</ Link>
                    }
                     
                    {/* <!--BACK BUTTON--> */}
                    <Link className="single_goback" to="/posts"><i className="fas fa-arrow-left"></i> Go Back</ Link>

                    </div>
                </div>

                {/* <!--RIGHT SECTION--> */}
                <div className="single_right">

                    {/* <!--TITLE--> */}
                    <h2> {state.post.title} </h2>

                    {/* <!--ALBUM--> */}
                    {state.post.category_id == 0 ? null : 
                        <p className="detail"> 
                            <Link to={`/album/${state.post.category_id}`}>This post is a part of {state.category.title}</Link>
                        </p>
                    }
                       
                    {/* <!--DESCRIPTION--> */}
                    <div className="single_desc"> {ReactHtmlParser(state.post.body)}  </div>
                </div>
    
    </article>
    }

    <Footer white={true}></Footer>
    </div>    </div>
    );
}

export default PostSingle;
