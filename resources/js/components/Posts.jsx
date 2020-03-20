import React, {useState, useEffect} from 'react';
import Header from './partials/Header'
import Footer from './partials/Footer'
import {Link} from 'react-router-dom'

const Posts = () => {

    const [state, setState] = useState({});
    const [loading, setLoading] = useState(true);

    const fetchItems = async () => {
        await fetch('/api/post')
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
      
                <div className="mainGallery">

        { loading ? "loading" :

      <div className="gal_area_container"><div className="gal_area">
        
        {state.posts.map((post) => { 
            return (
            <Link key={post.id} style={{ "backgroundImage" : " url('img/uploads/image.5e740cac5a93b5.27426162.png');"}} className="image_link" to={`post/${post.id}`}>
                <div className="filter">
                    <h2 className="name">{post.title}</h2>  
                </div>
            </Link>
           )
        })}
        </div>
  </div>
}

 
</div>

<Footer></Footer>
                
            </div>
            
            
        </div>
    );
}

export default Posts;
