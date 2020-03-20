import React, {useState, useEffect} from 'react';
import Header from './partials/Header'
import Footer from './partials/Footer'
import {Link} from 'react-router-dom'
import ReactHtmlParser from 'react-html-parser'


const AlbumSingle = (props) => {


    const [state, setState] = useState({});
    const [posts, setPosts] = useState({});
    const [loading, setLoading] = useState(true);

    const fetchItem = async () => {
        await fetch('/api/category/' + props.match.params.id)
        .then((response) => {
            return response.json();
          })
        .then((data) => {
            setState(data);

            // fetch posts
            fetch('/api/post')
            .then((response) => response.json())
            .then((data) => { setPosts(data.posts); setLoading(false); });

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
            {loading ? "loading..." : 
                <div class="album_single_container">
                    <div class="album_single_area">
                        <h1>{state.category.title}</h1>
                        <img src="img/uploads/album_covers/album.5e4979d16e7074.26287789.jpg" />
                        <div class="album_single_desc">{ReactHtmlParser(state.category.body)}</div>
                    </div>
                    <div class="album_posts_section_header">
                            Posts within <span class="italic">All</span>
                    </div>

                    <div class="gal_area">      
                        {
                            posts.map((post) => {
                                if(post.category_id != state.category.id) {
                                return null;
                                }
                                return (
                                    <Link style={{ "backgroundImage" : " url('img/uploads/image.5e740cac5a93b5.27426162.png');"}} class="image_link" to={`/post/${post.id}`}>
                                        <div class="filter">
                                            <h2 class="name name_album_single"> {post.title}</h2>
                                        </div>
                                    </Link> 
                                );
                            })
                        }
                    </div> 
                </div>
            }
        </div>
    </div>
    );
}

export default AlbumSingle;
