import React, {useState, useEffect, useRef} from 'react';
import Header from './partials/Header'
import Footer from './partials/Footer'
import Loading from './partials/Loading'
import {Link} from 'react-router-dom'

const Posts = () => {

    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;

    const [state, setState] = useState({});
    const [loading, setLoading] = useState(true);

    // paginaton
    const [currentPage, setCurrentPage] = useState(1);
    const [postsPerPage, setPostsPerPage] = useState(12);
    const [isLastPage, setIsLastPage] = useState(false);

    let indexOfLastPost = currentPage * postsPerPage;
    let indexOfFirstPost = indexOfLastPost - postsPerPage;

    const [isFetching,setIsFetching] = useState(false);
    const mountedRef = useRef(true);
 
    const recalcPagination = (newPage) => {
        setCurrentPage(newPage);

        let data = {...state};

        let currentPosts = data.posts.slice(indexOfFirstPost, indexOfLastPost);
        indexOfLastPost >= data.posts.length ? setIsLastPage(true) : setIsLastPage(false);
        setState({...data, currentPosts});
        
    }

    const fetchItems = async (apiUrl = `/api/post`) =>  {
            
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

                console.log(["post from posts", response]);
                return response.json();

            }).then(data => {
            if(mountedRef.current){
                // add the current range of posts to the state
                let currentPosts = data.posts.slice(indexOfFirstPost, indexOfLastPost);
                indexOfLastPost >= data.posts.length ? setIsLastPage(true) : setIsLastPage(false);
                setState({...data, currentPosts});    
                setLoading(false);
                setIsFetching(false);
            }
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
            mountedRef.current = false;
            if(isFetching){
                controller.abort();
                setIsFetching(false);
            }
        };
    }, [setIsFetching]);


    useEffect(() => {
        if(!loading && !isFetching) {
        recalcPagination(currentPage);
    }
    }, [currentPage])
    

    // paginator page functions
    const nextPage = () => {
        setCurrentPage(currentPage + 1);
    }

    const prevPage = () => {
        setCurrentPage(currentPage - 1);
    }

    return (
        <div>
            <Header />

            <div id="mainContent" className="main_content">
            { loading ? <Loading /> :
                <div>
                    <div className="mainGallery">
                        <div className="gal_area_container">
                            <div className="gal_area">
                                {state.currentPosts.map((post) => { 
                                    return (
                                    <Link   key={post.id}
                                            style={{ backgroundImage:  `url('${post.thumbnail}')` }}
                                            className="image_link" to={`post/${post.id}`}>

                                        <div className="filter">
                                            <h2 className="name">{post.title}</h2>  
                                        </div>
                                    </Link>
                                    )
                                    })
                                }
                            </div>
                        </div>
                    </div>
                    {/* Paginator Buttons */}
                    <div className="frontend_pagination_container">
                        {currentPage > 1 && <button className="pagination_button" onClick={() => prevPage()}><i class="fas fa-arrow-circle-left"></i></button>}
                        {!isLastPage && <button className="pagination_button" onClick={() => nextPage()}><i class="fas fa-arrow-circle-right"></i></button>}
                    </div>
                </div>
        }

                <Footer></Footer>       
            </div> 
        </div>
    );
}

export default Posts;
