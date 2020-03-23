import React from 'react';

const Footer = (props) => {
    return (
            <footer style={props.white ? {backgroundColor : 'white'} : null} className={props.opacity ? "contactSection opacity" : "contactSection"}>
                  <br/>
                  astra.london24@gmail.com <br/><br/><a href="https://www.jsparrow.uk"> astralondon.me  by James Sparrow </a>
            </footer>
    );
}

export default Footer;
