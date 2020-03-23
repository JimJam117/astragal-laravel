import React, {useState, useEffect, useRef} from 'react';
import Header from './partials/Header'
import Loading from './partials/Loading'
import Footer from './partials/Footer'
import {Link} from 'react-router-dom'
import ReactHtmlParser from 'react-html-parser'


const AlbumSingle = (props) => {

    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;

    const [state, setState] = useState({});
    const [posts, setPosts] = useState({});
    const [loading, setLoading] = useState(true);

    // paginaton
    const [currentPage, setCurrentPage] = useState(1);
    const [postsPerPage, setPostsPerPage] = useState(2);
    const [isLastPage, setIsLastPage] = useState(false);

    let indexOfLastPost = currentPage * postsPerPage;
    let indexOfFirstPost = indexOfLastPost - postsPerPage;

    const [isFetching,setIsFetching] = useState(false);
    const mountedRef = useRef(true);
 
    const fetchItem = async (apiUrl = '/api/category/' + props.match.params.id) =>  {
            
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

                console.log(["album from albumSingle", response]);
                return response.json();

            }).then(data => {
                if(mountedRef.current){
                    setState(data);
                }
                return fetch('/api/post/');

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

                console.log(["posts from albumSingle", response]);
                return response.json();

            }).then(postsData => {
            if(mountedRef.current){
                const postsInAlbum = postsData.posts.filter((post) => post.category_id == props.match.params.id);
                // add the current range of posts to the state
                let currentPosts = postsInAlbum.slice(indexOfFirstPost, indexOfLastPost);
                indexOfLastPost >= postsInAlbum.length ? setIsLastPage(true) : setIsLastPage(false);
                setPosts({...postsData, currentPosts});
                setLoading(false); 
                setIsFetching(false);
            }
        })

        //err catch
        .catch((e) => {
            if (e.name !== "AbortError") {
                if (e.message === "404" || e.name === "TypeError") {
                    window.location.href = "/not-found";
                    //console.log(e);
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
                fetchItem();
            }, 2000);
        };
        return () => {
            mountedRef.current = false;
            if(isFetching){
                controller.abort();
                setIsFetching(false);
            }
        };
    }, [setIsFetching]);



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
                    <div className="album_single_container">
                        <div className="album_single_area">
                            <h1>{state.category.title}</h1>
                            <img src={state.category.image} />
                            <div className="album_single_desc">{ReactHtmlParser(state.category.body)}</div>
                        </div>
                        <div className="album_posts_section_header">
                                Posts within <span className="italic">All</span>
                        </div>

                        <div className="gal_area">      
                            {
                                posts.currentPosts.map((post) => {
                                    if(post.category_id != state.category.id) {
                                    return null;
                                    }
                                    return (
                                        <Link key= {post.id} style={{ backgroundImage : `url(${post.image})`}} className="image_link" to={`/post/${post.id}`}>
                                            <div className="filter">
                                                <h2 className="name name_album_single"> {post.title}</h2>
                                            </div>
                                        </Link> 
                                    );
                                })
                            }
                        </div> 
                    </div>

                    <div className="frontend_pagination_container">
                        {currentPage > 1 && <button onClick={() => prevPage()}>Prev page</button>}
                        {!isLastPage && <button onClick={() => nextPage()}>Next page</button>}
                    </div>
                </div>
            }
            <Footer></Footer>
        </div>
    </div>
    );
}

export default AlbumSingle;
