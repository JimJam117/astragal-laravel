import React, {useState, useEffect} from 'react';
import Header from './partials/Header'
import Loading from './partials/Loading'
import Footer from './partials/Footer'
import {Link} from 'react-router-dom'
import ReactHtmlParser from 'react-html-parser'


const AlbumSingle = (props) => {


    const [state, setState] = useState({});
    const [posts, setPosts] = useState({});
    const [loading, setLoading] = useState(true);


    // paginaton
    const [currentPage, setCurrentPage] = useState(1);
    const [postsPerPage, setPostsPerPage] = useState(2);
    const [isLastPage, setIsLastPage] = useState(false);

    let indexOfLastPost = currentPage * postsPerPage;
    let indexOfFirstPost = indexOfLastPost - postsPerPage;


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
            .then((data) => { 
                const postsInAlbum = data.posts.filter((post) => post.category_id == state.category.id);

                // add the current range of posts to the state
                let currentPosts = postsInAlbum.slice(indexOfFirstPost, indexOfLastPost);
                indexOfLastPost >= postsInAlbum.length ? setIsLastPage(true) : setIsLastPage(false);
                setPosts({...data, currentPosts});
                setLoading(false); 
            });

            }
        );
        
    }

    useEffect(() => {
        loading ? fetchItem() : null;
    });


    // paginator page functions
    const nextPage = () => {
        setCurrentPage(currentPage + 1);
        setLoading(true);
    }

    const prevPage = () => {
        setCurrentPage(currentPage - 1);
        setLoading(true);
    }


    return (
    <div>
        <Header></Header>

        <div id="mainContent" className="main_content">
            {loading ? <Loading />: 
                <div>
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
                                posts.currentPosts.map((post) => {
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

                    <div class="frontend_pagination_container">
                        {currentPage > 1 && <button onClick={() => prevPage()}>Prev page</button>}
                        {!isLastPage && <button onClick={() => nextPage()}>Next page</button>}
                    </div>
                </div>
            }
        </div>
    </div>
    );
}

export default AlbumSingle;
