/*
    Message modal - andydevs69420
    | v0.0.1
    ;
*/ 


class MessageModal
{   
    /**
     * Make message modal instance
     * @return self
     **/ 
    constructor(id)
    {
        if  (!id.startsWith("#") || typeof(id) !== "string")
            throw "Invalid query selector for \"ID\"";

        this.elid = id;
        this.message_modal = $(this.elid);
    }

    show(title, message)
    {
        $(this.elid+"-title").text(title);
        $(this.elid+"-message").text(message);
        this.message_modal.modal("show");
    }
}

