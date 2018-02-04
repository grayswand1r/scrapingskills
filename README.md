# scrapingskills
- Site is [Kinja Deals](https://deals.kinja.com)
- Pages we're reading start with `All The Best Deals:` with text afterwards. Example: `All The Best Deals: OLED TVs, Valentine's Day Watches, Mario Odyssey, and More`
- Look like most every link on the site is JS generated. For pages we're reading, titles/links are inside an `<a>` tag nested in an H1 element:
> <h1 class="headline entry-title js_entry-title"><a onclick="window.ga('send', 'event', 'Kinja Deals click', 'position 5', 'https:\/\/deals.kinja.com\/all-the-best-deals-1822529788', {metric23: 1});" href="https://deals.kinja.com/all-the-best-deals-1822529788" class="js_entry-link">All The Best Deals: OLED TVs, Valentine&#39;s Day Watches, <i>Mario Odyssey</i>, and More</a></h1>
