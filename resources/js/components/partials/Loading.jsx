import React from 'react'
import FadeLoader from "react-spinners/FadeLoader";

export default function Loading() {
    return (
        <div className ="loading-page">
        <FadeLoader
          height={15}
          width={5}
          radius={2}
          margin={2}
          color={"#555"}
          loading={true}
        />
        </div>
    )
}
