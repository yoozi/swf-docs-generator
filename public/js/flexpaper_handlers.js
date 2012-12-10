/**
 █▒▓▒░ The FlexPaper Project

 This file is part of FlexPaper.

 FlexPaper is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, version 3 of the License.

 FlexPaper is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with FlexPaper.  If not, see <http://www.gnu.org/licenses/>.

 For more information on FlexPaper please see the FlexPaper project
 home page: http://flexpaper.devaldi.com
 */

$(function() {
    /**
     * Handles the event of external links getting clicked in the document.
     *
     * @example onExternalLinkClicked("http://www.google.com")
     *
     * @param String link
     */
    jQuery('#viewerPlaceHolder').bind('onExternalLinkClicked',function(e,link){

    });

    /**
     * Recieves progress information about the document being loaded
     *
     * @example onProgress( 100,10000 );
     *
     * @param int loaded
     * @param int total
     */
    jQuery('#viewerPlaceHolder').bind('onProgress',function(e,loadedBytes,totalBytes){

    });

    /**
     * Handles the event of a document is in progress of loading
     *
     */
    jQuery('#viewerPlaceHolder').bind('onDocumentLoading',function(e){

    });

    /**
     * Handles the event of a document is in progress of loading
     *
     */
    jQuery('#viewerPlaceHolder').bind('onPageLoading',function(e,pageNumber){

    });

    /**
     * Receives messages about the current page being changed
     *
     * @example onCurrentPageChanged( 10 );
     *
     * @param int pagenum
     */
    jQuery('#viewerPlaceHolder').bind('onCurrentPageChanged',function(e,pagenum){

    });

    /**
     * Receives messages about the document being loaded
     *
     * @example onDocumentLoaded( 20 );
     *
     * @param int totalPages
     */
    jQuery('#viewerPlaceHolder').bind('onDocumentLoaded',function(e,totalPages){

    });

    /**
     * Receives messages about the page loaded
     *
     * @example onPageLoaded( 1 );
     *
     * @param int pageNumber
     */
    jQuery('#viewerPlaceHolder').bind('onPageLoaded',function(e,pageNumber){

    });

    /**
     * Receives messages about the page loaded
     *
     * @example onErrorLoadingPage( 1 );
     *
     * @param int pageNumber
     */
    jQuery('#viewerPlaceHolder').bind('onErrorLoadingPage',function(e,pageNumber){

    });

    /**
     * Receives error messages when a document is not loading properly
     *
     * @example onDocumentLoadedError( "Network error" );
     *
     * @param String errorMessage
     */
    jQuery('#viewerPlaceHolder').bind('onDocumentLoadedError',function(e,errMessage){

    });

    /**
     * Receives error messages when a document has finished printed
     *
     * @example onDocumentPrinted();
     *
     */
    jQuery('#viewerPlaceHolder').bind('onDocumentPrinted',function(e){

    });
});