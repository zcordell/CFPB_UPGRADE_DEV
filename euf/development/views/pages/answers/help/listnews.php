<rn:meta title="Frequently Asked Questions" template="cfpb.php" clickstream="answer_list" use_profile_defaults="true" login_required="true"/>

<rn:widget path="knowledgebase/RssIcon2" icon_path="" />
<div id="rn_PageTitle" class="rn_AnswerList">
    <h6><?=getLabel('GET_ANSWERS_LBL');?></h6>
</div>

    <rn:condition is_spider="false">
        <div id="rn_SearchControls">
            <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
            <form method="post" action="" onsubmit="return false" >
                <div class="rn_SearchInput">
                    <rn:widget path="search/KeywordText2" label_text="#rn:msg:FIND_THE_ANSWER_TO_YOUR_QUESTION_CMD#" 
                      initial_focus="true" report_id="#rn:php:getSetting('NEWS_REPORT_ID')#"/>
                </div>
                <rn:widget path="search/SearchButton2" report_id="#rn:php:getSetting('NEWS_REPORT_ID')#" report_page_url="/app/answers/help/listnews"/>
            </form>
            <rn:widget path="search/DisplaySearchFilters" report_id="#rn:php:getSetting('NEWS_REPORT_ID')#"/>
        </div>
    </rn:condition>

<div id="rn_PageContent" class="rn_AnswerList">
    <div class="answers_subtab">
        <div class ="tab">
            <a href = "/app/answers/help/list">FAQ's</a>
        </div>
        <div class ="selectedtab">
            <a href = "javascript:void(0);">News</a>
        </div>
    </div>
    <div class="rn_Padding">
        <h2 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_RESULTS_CMD#</h2>
        <rn:widget path="knowledgebase/TopicWords2"/>
        <rn:widget path="reports/Multiline2" report_id="#rn:php:getSetting('NEWS_REPORT_ID')#" per_page="10" truncate_size="300"/>
        <rn:widget path="reports/Paginator" report_id="#rn:php:getSetting('NEWS_REPORT_ID')#"/>
    </div>
</div>