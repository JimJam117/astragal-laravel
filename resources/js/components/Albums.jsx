import React, {useState, useEffect, useRef} from 'react';
import Header from './partials/Header'
import Footer from './partials/Footer'
import Loading from './partials/Loading'
import {Link} from 'react-router-dom'
import ReactHtmlParser from 'react-html-parser'


const Albums = () => {
    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;
    
    const [state, setState] = useState({});
    const [loading, setLoading] = useState(true);
    
    // paginaton
    const [currentPage, setCurrentPage] = useState(1);
    const [postsPerPage, setPostsPerPage] = useState(6);
    const [isLastPage, setIsLastPage] = useState(false);

    let indexOfLastPost = currentPage * postsPerPage;
    let indexOfFirstPost = indexOfLastPost - postsPerPage;

    const [isFetching,setIsFetching] = useState(false);
    const mountedRef = useRef(true);
 

    const recalcPagination = (newPage) => {
        setCurrentPage(newPage);

        let data = {...state};

        let currentItems = data.categories.slice(indexOfFirstPost, indexOfLastPost);
        indexOfLastPost >= data.categories.length ? setIsLastPage(true) : setIsLastPage(false);
        setState({...data, currentItems});
    }


    const fetchItems = async (apiUrl = `/api/category`) =>  {
            
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

                console.log(["album from albums", response]);
                return response.json();

            }).then(data => {
            if(mountedRef.current){
                // add the current range of categories to the state
                let currentItems = data.categories.slice(indexOfFirstPost, indexOfLastPost);
                indexOfLastPost >= data.categories.length ? setIsLastPage(true) : setIsLastPage(false);
                setState({...data, currentItems});
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
                {loading ? <Loading /> : 
                    <div>
                        <div className="alb_area_container"> 
                            <div className="alb_area">
                            {
                                state.currentItems.map((category) => {
                                    return (
                                    <Link key={category.id} className="album_link" to={`/album/${category.id}`}>
                                        <div className="album_link_img" style={{ "backgroundImage" : `url(${category.image})`}}></div>

                                        <div className="album_link_text">
                                            <h2 className="album_link_name">{category.title}</h2>
                                            <p className="album_link_desc"> {ReactHtmlParser(category.body)} </p>
                                        </div>
                                    </Link>
                                    )
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

export default Albums;
