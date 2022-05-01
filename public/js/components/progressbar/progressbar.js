/**
 * Progressbar v1 andydevs69420
 * | requires jquery
 * ; 
 * 
 **/

class Progressbar
{
    /**
     * Make progressbar instance
     * @param String id_query 
     * @return self
     **/
    constructor(id)
    {
        if  (!id.startsWith("#") || typeof(id) !== "string")
            throw "Invalid query selector for \"ID\"";

        this.elid = id;
        this.pbar = $(this.elid);
        jQuery(() => {
            this.rfld = this.__getRequiredFields();
            this.__paint();
        })
    }


    /**
     * Gets input|textarea with required attribute
     * @return null 
     **/
    __getRequiredFields()
    { return $('input[required]:visible, select[required], textarea[required]:visible'); }


    /**
     * Paints progress 
     * @return null
     **/
    __paint()
    {
        if (!(this.rfld !== null || this.rfld !== undefined))
            return;
            
        let child_count, actual_count;

        child_count  = this.rfld.length;
        actual_count = 0;

        this.rfld.each((idx,child) => {

            if ($(child).val().trim().length > 0)
                actual_count++;
            else
                $(child).change((evt) => {
                    this.__paint();
                });
                
        });

        let percentage = (actual_count/child_count) * 100;

        $(`${ this.elid }-progress`)
        .css('width', `${percentage}%`)
        .attr('aria-valuenow', `${percentage}`);

    }

    /**
     * Updates progress
     * @return null
     **/
    update()
    { 
        this.rfld = this.__getRequiredFields();
        this.__paint(); 
    }

}
