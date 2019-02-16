

# [![Google Scholar](https://scholar.google.com/intl/en/scholar/images/1x/scholar_logo_30dp.png)](https://scholar.google.com/schhp?hl=en)

[Search Scholar](https://scholar.google.com/schhp?hl=en)

-   [About](https://scholar.google.com/intl/en/scholar/about.html)
-   [Search](https://scholar.google.com/intl/en/scholar/help.html)
-   [Citations](https://scholar.google.com/intl/en/scholar/citations.html)
-   Inclusion
-   [Metrics](https://scholar.google.com/intl/en/scholar/metrics.html)
-   [Publishers](https://scholar.google.com/intl/en/scholar/publishers.html)
-   [Libraries](https://scholar.google.com/intl/en/scholar/libraries.html)

-   [Overview](https://scholar.google.com/intl/en/scholar/inclusion.html#overview)
-   [Content](https://scholar.google.com/intl/en/scholar/inclusion.html#content)
-   [Crawl](https://scholar.google.com/intl/en/scholar/inclusion.html#crawl)
-   [Indexing](https://scholar.google.com/intl/en/scholar/inclusion.html#indexing)
-   [Troubleshooting](https://scholar.google.com/intl/en/scholar/inclusion.html#troubleshooting)
-   [Questions](https://scholar.google.com/intl/en/scholar/inclusion.html#faq)

## Inclusion Guidelines for Webmasters

Indexing Guidelines

Google Scholar uses automated software, known as "parsers", to identify bibliographic data of your papers, as well as references between the papers. Incorrect identification of bibliographic data or references will lead to poor indexing of your site. Some documents may not be included at all, some may be included with incorrect author names or titles, and some may rank lower in the search results, because their (incorrect) bibliographic data would not match (correct) references to them from other papers. To avoid such problems, you need to provide bibliographic data and references in a way that automated "parser" software can process.

1. Preparing article URLs

Place each article and each abstract in a separate HTML or PDF file. At this time, we're unable to effectively index multiple abstracts on the same webpage or multiple papers in the same PDF file. Likewise, we're unable to index different sections of the same paper in different files. Each paper must have its own unique URL in order for it to be included in Google Scholar.

2. Configuring the meta-tags

If you're using repository or journal management software, such as Eprints, DSpace, Digital Commons or OJS, please configure it to export bibliographic data in HTML "<meta>" tags. Google Scholar supports Highwire Press tags (e.g., citation_title), Eprints tags (e.g., eprints.title), BE Press tags (e.g., bepress_citation_title), and PRISM tags (e.g., prism.title). Use Dublin Core tags (e.g., DC.title) as a last resort - they work poorly for journal papers because Dublin Core doesn't have unambiguous fields for journal title, volume, issue, and page numbers. To check that these tags are present, visit several abstracts and view their HTML source.

1.  The title tag, e.g., **citation_title** or DC.title, must contain the title of the paper. Don't use it for the title of the journal or a book in which the paper was published, or for the name of your repository. This tag is required for inclusion in Google Scholar.
    
2.  The author tag, e.g., citation_author or DC.creator, must contain the authors (and only the actual authors) of the paper. Don't use it for the author of the website or for contributors other than authors, e.g., thesis advisors. Author names can be listed either as "Smith, John" or as "John Smith". Put each author name in a separate tag and omit all affiliations, degrees, certifications, etc., from this field. At least one author tag is required for inclusion in Google Scholar.
    
3.  The publication date tag, e.g., **citation_publication_date** or DC.issued, must contain the date of publication, i.e., the date that would normally be cited in references to this paper from other papers. Don't use it for the date of entry into the repository - that should go into citation_online_date instead. Provide full dates in the "2010/5/12" format if available; or a year alone otherwise. This tag is required for inclusion in Google Scholar.
    
4.  For journal and conference papers, provide the remaining bibliographic citation data in the following tags: **citation_journal_title** or **citation_conference_title**, citation_issn, citation_isbn, citation_volume, citation_issue, citation_firstpage, and citation_lastpage. Dublin Core equivalents are DC.relation.ispartof for journal and conference titles and the non-standard tags DC.citation.volume, DC.citation.issue, DC.citation.spage (start page), and DC.citation.epage (end page) for the remaining fields. Regardless of the scheme chosen, these fields must contain sufficient information to identify a reference to this paper from another document, which is normally all of: (a) journal or conference name, (b) volume and issue numbers, if applicable, and (c) the number of the first page of the paper in the volume (or issue) in question.
    
5.  For theses, dissertations, and technical reports, provide the remaining bibliographic citation data in the following tags: citation_dissertation_institution, citation_technical_report_institution or DC.publisher for the name of the institution and citation_technical_report_number for the number of the technical report. As with journal and conference papers, you need to provide sufficient information to recognize a formal citation to this document from another article.
    
6.  For all document types, the guiding principle is to present your article as it would normally be cited in the "References" section of another paper. E.g., citations to technical reports normally include their assigned numbers, so the number of the report should be present in some appropriate field. Likewise, the name of the journal should be written as "Transactions on Magic Realism" or "Trans. Mag. Real.", not as "Magic Realism, Transactions on" or "T12". Omission or unusual presentation of key bibliographic fields can lead to mis-identification of your articles.
    
7.  All tag values are HTML attributes, so you must escape special characters appropriately. E.g., <meta name="citation_title" content="&quot;Andar com meus sapatos&quot; - uma an&#225;lise cr&#237;tica">. There's no need to escape characters that are written directly in your webpage's character encoding, such as Latin diacritics on a page in ISO-8859-1. However, you must still escape the quotes and the angle brackets.
    
8.  The "<meta>" tags normally apply only to the exact page on which they're provided. If this page shows only the abstract of the paper and you have the full text in a separate file, e.g., in the PDF format, please specify the locations of  **all**  full text versions using citation_pdf_url or DC.identifier tags. The content of the tag is the absolute URL of the PDF file; for security reasons, it must refer to a file in the same subdirectory as the HTML abstract.
    
    > Failure to link the alternate versions together could result in the incorrect indexing of the PDF files, because these files would be processed as separate documents without the information contained in the meta tags.
    

Example:

<meta name="citation_title" content="The testis isoform of the phosphorylase kinase catalytic subunit (PhK-T) plays a critical role in regulation of glycogen mobilization in developing lung">

<meta name="citation_author" content="Liu, Li">

<meta name="citation_author" content="Rannels, Stephen R.">

<meta name="citation_author" content="Falconieri, Mary">

<meta name="citation_author" content="Phillips, Karen S.">

<meta name="citation_author" content="Wolpert, Ellen B.">

<meta name="citation_author" content="Weaver, Timothy E.">

<meta name="citation_publication_date" content="1996/05/17">

<meta name="citation_journal_title" content="Journal of Biological Chemistry">

<meta name="citation_volume" content="271">

<meta name="citation_issue" content="20">

<meta name="citation_firstpage" content="11761">

<meta name="citation_lastpage" content="11766">

<meta name="citation_pdf_url" content="http://www.example.com/content/271/20/11761.full.pdf">

Keep in mind that, regardless of the meta-tag scheme chosen, you need to provide at least three fields: (1) the title of the article, (2) the full name of at least the first author, and (3) the year of publication. Pages that don't provide any one of these three fields will be processed as if they had no meta tags at all. Likewise, all PDF files will be processed as if they had no meta tags at all, unless they're linked from the corresponding HTML abstracts using citation_pdf_url or DC.identifier tags. It works best to provide the meta-tags for all versions of your paper, not just for one of the versions.

2.a. Indexing of content without the meta-tags

If it's not practical for you to implement the HTML "<meta>" tags, e.g., if your papers are only available in the PDF format, then the document needs to be visually laid out according to the following conventions.

1.  The title of the paper must be the largest chunk of text on top of the page. Either use font size of at least 24 pt. in PDF, or place the title inside an "<h1>" or an "<h2>" tag in HTML, or use a CSS class named "citation_title". Please use the same font for the entire title. Make sure that all other text on the page, in particular the name of the repository or the journal, is set in a smaller font than the title of the paper - otherwise, this other, larger, text may be incorrectly interpreted as the title of the paper.
    
2.  The authors of the paper must be listed right before or right after the title, in a slightly smaller font that is still larger than normal text. Either use a 16-23 pt. font in PDF, or place the authors inside an "<h3>" tag in HTML, or wrap them in a CSS class named "citation_author". Please use the same font for all author names. Make sure the names of the repository and the journal, as well as the text of the section headings, are set in a smaller font than the authors of the paper - otherwise, this other, larger, text may be incorrectly interpreted as the authors. Use "Sentence case" as opposed to "Title Case" for section headings et. al., to avoid confusion with author names. Separate multiple author names with commas or semicolons and omit their affiliations, degrees, and certifications from the author line. Use an explicit format such as "by John Smith" or "Author: John Smith", if appropriate.
    
3.  Include a bibliographic citation to a published version of the paper on a line by itself, and place it inside the header or the footer of the first page in the PDF file, or next to the title and the authors in HTML. Use an explicit citation format, e.g.: "J. Biol. Chem., vol. 234, no. 8, pp. 1971-1975, August 1959". If the paper is unpublished, include the full date of its present version on a line by itself, e.g., "August 12, 2009".
    
4.  Avoid use of Type 3 fonts in PDF files, because they're often generated with missing or incorrect font size and character encoding information, which makes it difficult for our parser software to extract the bibliographic data. You can check the types of the fonts under the File -> Properties... menu in Adobe Acrobat Reader. If you're using LaTeX, consider switching to Type 1 fonts, e.g., \usepackage{times}, \usepackage{helvet}, or \usepackage{palatino}.
    

> Please understand that it's not possible for our automated parsers to correctly identify bibliographic data in such loosely defined formats with 100% accuracy; and that failure to correctly identify certain fields can lead to exclusion of your papers from Google Scholar. If you're not satisfied with the accuracy of your Google Scholar results, you need to create HTML pages with abstracts and add the "<meta>" tags to them, as described above.

3. Marking the references

Mark the section of the paper that contains references to other works with a standard heading, such as "References" or "Bibliography", on a line just by itself. Individual references inside this section should be either numbered "1. - 2. - 3." or "[1] - [2] - [3]" in PDF, or put inside an "<ol>" list in HTML. The text of each reference must be a formal bibliographic citation in a commonly used format,  _without free-form commentary_.

Please understand that the references are identified automatically by the parser software; they're not entered or corrected by human operators. While we try to support the most common reference formats, it is not possible to guarantee that all references are identified correctly; and incorrect identification of references could lead to exclusion of your papers from Google Scholar or to low ranking of your papers in the search results.

-   [Google](https://www.google.com/webhp?hl=en)
-   [Privacy & Terms](https://www.google.com/intl/en/policies/)
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTE4OTAxNTA4NjBdfQ==
-->