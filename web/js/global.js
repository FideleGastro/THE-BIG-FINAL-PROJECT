async function fetchArticle(id, projet) {
    const url = '/query/'+ id;
    const response = await fetch(url);
    const data = await response.json();
    //debugger
    console.log(data.resultList.result[0].id);
    if (fetch('/article/get/'+id) == true){
        console.log('déjà dans la BDD');
        return false;
    }

    const url2 = '/article/post/'+ data.resultList.result[0].id+'/'+projet
    fetch(url2);
    console.log('fini');
    //return await response.json()
}