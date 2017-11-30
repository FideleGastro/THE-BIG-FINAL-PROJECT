async function fetchArticle(id) {
    const url = '/query/'+ id;
    const response = await fetch(url);
    const data = await response.json();
    //debugger
    console.log(data.resultList.result[0].pmcid);
    if (fetch('/article/get/'+id) == TRUE){
        console.log('déjà dans la BDD');
        return false;
    }

    const url2 = '/article/post/'+ data.resultList.result[0].id
    fetch(url2)
    //return await response.json()
}