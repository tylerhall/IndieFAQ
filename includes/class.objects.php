<?PHP
    // Stick your DBOjbect subclasses in here (to help keep things tidy).

    class User extends DBObject
    {
        public function __construct($id = null)
        {
            parent::__construct('users', array('nid', 'username', 'password', 'level'), $id);
        }
    }

    class KBArticle extends DBObject
    {
        public function __construct($id = null)
        {
            parent::__construct('kb_articles', array('title', 'slug', 'body', 'section_id', 'keywords', 'published', 'dt_created', 'dt_modified', 'pinned', 'views'), $id);
        }

		public function url()
		{
			return $this->id . '/' . $this->slug . '/';
		}
	}

    class KBSection extends DBObject
    {
        public function __construct($id = null)
        {
            parent::__construct('kb_sections', array('title'), $id);
        }

		public function alphabeticalArticles()
		{
			$articles = DBObject::glob('KBArticle', "SELECT * FROM kb_articles WHERE section_id = '{$this->id}' AND published = '1' ORDER BY pinned DESC, title ASC, dt_modified DESC");
			return $articles;			
		}

		public function mostRecentArticles()
		{
			$articles = DBObject::glob('KBArticle', "SELECT * FROM kb_articles WHERE section_id = '{$this->id}' AND published = '1' ORDER BY pinned DESC, dt_modified DESC");
			return $articles;			
		}

		public function mostPopularArticles()
		{
			$articles = DBObject::glob('KBArticle', "SELECT * FROM kb_articles WHERE section_id = '{$this->id}' AND published = '1' ORDER BY pinned DESC, views DESC, dt_modified DESC");
			return $articles;			
		}
	}
