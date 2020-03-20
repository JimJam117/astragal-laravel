import React, {useState, useEffect} from 'react';
import Header from './partials/Header'
import Footer from './partials/Footer'
import {Link} from 'react-router-dom'

import ReactHtmlParser from 'react-html-parser';

const PostSingle = (props) => {


    const [state, setState] = useState({});
    const [loading, setLoading] = useState(true);

    const fetchItem = async () => {
        await fetch('/api/post/' + props.match.params.id)
        .then((response) => {
            console.log(response);
            return response.json();
          })
        .then((data) => {
            setState(data);
            setLoading(false);
            console.log(data)
            }
        );


    }

    useEffect(() => {
        loading ? fetchItem() : null;
    });

    console.log(state);

    return (
        <div>
            <Header></Header>
        <div id="mainContent" className="main_content">
            
        {loading ? <div>loading</div> :
        <article className="single">
   
                {props.match.params.body}
                <div className="single_left">

                    {/* <!--IMAGE--> */}
                    <div className="single_image_container">
                    <img className="single_image" src={state.post.image} alt={state.post.title} />
                    </div>

                    {/* <!--LINK BUTTONS--> */}
                    <div className="single_links">
                    <a className="single_download" href={`/img/uploads/${state.post.image}`} download><i className="fas fa-download"></i> Download</a>
                    <a className="single_viewfull" href={`/img/uploads/${state.post.image}`} target="_blank"><i className="far fa-image"></i> View Full Size</a>

                    {/* <!--ABLUM BUTTON--> */}
                    <Link className="single_viewalbum" to={`/album/${state.post.category_id}`}><i className="far fa-images"></i> View Album</ Link>
                    
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

    <Footer></Footer>
    </div>    </div>
    );
}

export default PostSingle;
