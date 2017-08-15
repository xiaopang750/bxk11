 template.helper('cut', function(content, num){

    var len;

    if( typeof content !== 'string' ) {
        return content;
    } else {
        
        len = content.length;

        if( len <= num ) {

            return content;

        } else {

            return content.substring(0, num) + '...';

        }

    }

});