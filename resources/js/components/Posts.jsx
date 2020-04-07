import React, {useState, useEffect, useRef} from 'react';
import Header from './partials/Header'
import Footer from './partials/Footer'
import Loading from './partials/Loading'
import {Link} from 'react-router-dom'


const Posts = () => {

    // abort controller
    var controller = new AbortController();
    var signal = controller.signal;


    const [loading, setLoading] = useState(true);
    const [results, setResults] = useState([]);
    const [posts, setPosts] = useState([]);

    // pagination state
    const [currentPage, setCurrentPage] = useState();
    const [lastPage, setLastPage] = useState();

    // pagination function
    const changePage = (pageToChangeTo) => {
        if(pageToChangeTo < 1 || pageToChangeTo > lastPage){
            console.log("Page to change to: " + pageToChangeTo + " is not within boundries");
        }
        else {
            setCurrentPage(pageToChangeTo);
            setLoading(true);
        }
    }


    const fetchItems = async (apiUrl = `/api/post/paginated?page=${currentPage}`) =>  {
        console.log("load");
                await fetch(apiUrl, {signal})
                    .then(async (response) => {
                        
                        //throw errors if issues
                        if (response.status === 500) {
                            console.log("500");
                        }
                        else if(response.status === 404) {
                            console.log("404");
                        }
                        else if(response.status === 419) {
                            console.log("419");
                        }
        
                        const data = await response.json();

                        console.log(currentPage);
                        setResults(data);

                        setCurrentPage(data.posts.current_page);
                        setLastPage(data.posts.last_page);

                        setPosts(data.posts.data);
                        setLoading(false);
                })
            }

    useEffect(() => {
        if (loading) {fetchItems()}
        return () => {
            controller.abort();
        };
    }, [loading])
    


    return(
        <div>
            <Header />

            <div id="mainContent" className="main_content">
            { loading ? <Loading /> :
                <div>
                    <div className="mainGallery">
                        <div className="gal_area_container">
                            <div className="gal_area">
                                {posts.map((post) => { 
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
                    <p className="pagination-label">Page {currentPage}</p>
                        {/* if the current page isn't 1, show last page button */}
                        {currentPage !== 1 ?
                            <button className="pagination_button" onClick={() => changePage(currentPage - 1)}><i class="fas fa-arrow-circle-left"></i></button> :
                            null
                        }
                        {/* if the current page isn't equal to the last page, show next page button */}
                        {currentPage !== lastPage ?
                            <button className="pagination_button" onClick={() => changePage(currentPage + 1)}><i class="fas fa-arrow-circle-right"></i></button> :
                            null
                        }
                    </div>
                </div>
        }

                <Footer></Footer>       
            </div> 
        </div>
    ) 

}

export default Posts;




