type="textarea/javascript"
    function test(obj, minRows){
    var txt=obj.value,
    rows=obj.rows,
    nbRows=txt.split('\n').length;
    if(nbRows>rows){
    obj.rows=obj.rows+1;
    }else if(rows>minRows){
        obj.rows=obj.rows-1;
    }
}
