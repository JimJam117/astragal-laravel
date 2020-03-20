import React, {useState, useEffect} from 'react';
import Header from './partials/Header'
import Footer from './partials/Footer'
import {Link} from 'react-router-dom'
import ReactHtmlParser from 'react-html-parser'


const Albums = () => {

    const [state, setState] = useState({});
    const [loading, setLoading] = useState(true);

    const fetchItems = async () => {
        await fetch('/api/category')
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
        loading ? fetchItems() : null;
    });

    return (
        <div>
            <Header />

            <div id="mainContent" className="main_content">
                {loading ? "loading..." : 
                    <div class="alb_area_container"> 
                        <div class="alb_area">
                        {
                            state.categories.map((category) => {
                                return (
                                <Link class="album_link" to={`/album/${category.id}`}>
                                    <div class="album_link_img" style={{ "backgroundImage" : " url('img/uploads/image.5e740cac5a93b5.27426162.png');"}}></div>

                                    <div class="album_link_text">
                                        <h2 class="album_link_name">{category.title}</h2>
                                        <p class="album_link_desc"> {ReactHtmlParser(category.body)} </p>
                                    </div>
                                </Link>
                                )
                            })

                        }
                        </div>
                    </div>
                }

                <Footer></Footer>
            </div>

        </div>
    );
}

export default Albums;
