/*!
* Start Bootstrap - Blog Home v5.0.5 (https://startbootstrap.com/template/blog-home)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-blog-home/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

let host = "http://localhost/Web/blog1/";
getAllPosts();

// let btn = document.querySelector('#addPost');
// btn.onpress = addPost;

async function addPost(){
    let data = {};
    data["title"] = document.querySelector("#title").value;
    data["text"] = document.querySelector("#text").value;
    console.log(data);

    let url = host + 'posts/';
    let options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({'data':data})
    };
    console.log(options);
    let response = await fetch(url, options);

    await response.json().then(res => {
        if(res['status']){
            getAllPosts();
        }else{
            error(res["message"]);
        }
    }); // читаем ответ в формате JSON

}

function render(posts){
    // let posts =  getAllPosts();
    let cols=[];
    
    for (let index = 0; index < posts.length; index++) {
        let post = posts[index];
        
        let date = document.createElement("div");
        date.className += "small text-muted";
        date.innerText = post['date'];

        let title = document.createElement("h2");
        title.className += "card-title h4";
        title.innerText = post['title'];
        
        let text = document.createElement('p');
        text.classList.add("card-text");
        text.innerText = post['text'];

        let link = document.createElement('a');
        link.className += "btn btn-primary";
        link.innerText = "Read more →";
        link.href = host + "posts/" + post['slug'];

        let cardBody = document.createElement('div');
        cardBody.classList.add("card-body");
        cardBody.appendChild(date);
        cardBody.appendChild(title);
        cardBody.appendChild(text);
        cardBody.appendChild(link);

        let img = document.createElement("img");
        img.classList.add("card-img-top");
        img.src = "assets/700x350.jpg";
        img.alt = "...";

        let imgLink = document.createElement("a");
        imgLink.appendChild(img);

        let card = document.createElement("div");
        card.className = "card mb-4";
        card.appendChild(imgLink);
        card.appendChild(cardBody);
        
        let col = document.createElement("div");
        col.classList.add("col-lg-6");
        col.appendChild(card);

        cols[index] = col;
    };

    let root = document.querySelector("#posts");

    for (let index = 0; index < cols.length; index++) {
        if(index % 2 == 0){
            let row = document.createElement("div");
            row.classList.add("row");
            row.appendChild(cols[index]);
            if(index + 1 < cols.length){
                row.appendChild(cols[index + 1]);
            }
            root.appendChild(row);
        }
    }
}

async function getAllPosts(){
    let url = host + 'posts/';
    let response = await fetch(url);

    await response
    .json()
    .then(data => {
        render(data.data);
    }); // читаем ответ в формате JSON
    
}

function error(msg){
    alert(msg);
}